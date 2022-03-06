from colorama import Fore, Back, Style
import subprocess
import sys
import os


# Folder name containing the website source code.
WEBSITE_FOLDER = 'website'


# Current folder absolute path.
CURRENT_FOLDER = os.path.dirname(os.path.abspath(__file__))


# Determine whether the given path exists
# from the current folder.
def isdir(path):
    if not path.startswith('/'):
        path = '/' + path
        
    return os.path.isdir(CURRENT_FOLDER + path)


# Class handling the console interface with
# the user.
class console(object):
    # Command indentation number.
    INDENT = 0
    
    # Possible values for Yes and No questions.
    YES_VALUES = ["y", "yes"]
    NO_VALUES  = ["n", "no"]
    
    # Generate the line start indentation.
    @staticmethod
    def _indent():
        return "  " * max(console.INDENT, 0)
    
    # Base console displayer with style.
    @staticmethod
    def _print(message, label, style, same_line):
        string = console._indent() + style + label + Style.RESET_ALL + " " + str(message)
        
        if same_line:
            print(string, end="", flush=True)
        else:
            print(string)
        
    # Display an error message and stop the program.
    @staticmethod
    def error(message, code=1, same_line=False):
        console._print(message, " ERROR ", Back.RED, same_line)
        sys.exit(code)
        
    # Display an info to the user.
    @staticmethod
    def info(message, same_line=False):
        console._print(message, " INFO ", Back.BLUE, same_line)
        
    # Display a success message to the user.
    @staticmethod
    def success(message, same_line=False):
        console._print(message, " SUCCESS ", Back.GREEN + Fore.BLACK, same_line)
        
    # Display a warning to the user.
    @staticmethod
    def warn(message, same_line=False):
        console._print(message, " WARNING ", Back.YELLOW + Fore.BLACK, same_line)
        
    # Ask something to the user.
    def ask(message):
        try:
            return input(console._indent() + Fore.GREEN + " ─▶ " + Fore.RESET + message)
        except KeyboardInterrupt:
            print()
            console.error('Aborted')
    
    # Ask something and returns a boolean.
    def boolean(message, highlited_choice):
        choices = "[Y/n]" if highlited_choice else "[y/N]"        
        value = console.ask(message + " " + Fore.YELLOW + choices + Fore.RESET + " ").lower()
        
        if value not in (console.YES_VALUES + console.NO_VALUES + [""]):
            console.warn("Unknown answer '" + value + "'. Retrying.")
            return console.boolean(message, highlited_choice)
        
        if value in console.YES_VALUES:
            return True
        elif value in console.NO_VALUES:
            return False
        
        return highlited_choice
        
        
# Main shell command interface.
class command(object):
    # Run a shell command.
    @staticmethod
    def run(message, command):
        console.info(message + "... ", same_line=True)
        code = subprocess.call(command, stdout=subprocess.DEVNULL, stderr=subprocess.STDOUT, shell=True)
        
        if code == 0:
            print(Fore.GREEN + "Done!" + Fore.RESET)
        else:
            print(Fore.RED + "Error!" + Fore.RESET)
            console.error("Error while executing '" + command + "'")
        
        return code
        
    # Run a Laravel artisan command.
    @staticmethod
    def artisan(message, _command):
        command.run(message, "php ./" + WEBSITE_FOLDER + "/artisan " + _command)


# Initialize the repository. Should
# be done once and for all.
def init():
    # If the source code was already generated.
    if isdir(WEBSITE_FOLDER):
        console.info("Folder '" + WEBSITE_FOLDER + "' already exists. Skipping creation.")
        command.run("Updating Composer", "composer update -d " + WEBSITE_FOLDER)
    else:
        command.run("Creating website source code", "composer create-project laravel/laravel " + WEBSITE_FOLDER)
        command.artisan("Publishing error pages", "vendor:publish --tag=laravel-errors")


# Deploy the website. This should be
# done every time this repository is
# cloned from the git.
def deploy():
    # TODO deploy (.env, module:link, storage:path, ln -s (for hosts))
    
    update_env = not os.path.isfile(WEBSITE_FOLDER + "/.env")
    
    # Should we update the .env file anyway?
    if not update_env:
        update_env = console.boolean(".env file already exists. Do you want to update it anyway?", False)
    
    # Should we update the .env file?
    if update_env:
        console.INDENT += 1
        
        # Is the code for local development?
        is_local = console.boolean("Are you in local environment?", False)
        # TODO to continue
        
        console.INDENT -= 1
    
    # Check whether the module is included in
    # the website source code.
    if isdir(WEBSITE_FOLDER + '/vendor/pythagus/laravel-abstract-basis'):
        command.artisan("Linking modules", "module:link")
    
    # Create the host link to the public folder.
    if console.boolean("Create symlink host for web server?", False):
        console.INDENT += 1
        name = console.ask("Virtual host name: ")
        command.run("Creating symbolic link for web server", "ln -s " + CURRENT_FOLDER + "/" + WEBSITE_FOLDER + "/public ~/" + name)
        console.INDENT -= 1
        
    console.success("Deployment completed!")


# Check script arguments number.
if len(sys.argv) <= 1:
    console.error("Too few arguments given (at least 1)")
    
type = str(sys.argv[1])
if type == "init":
    init()
elif type == "deploy":
    deploy()
else:
    console.error("Unknown type '" + type + "'")
