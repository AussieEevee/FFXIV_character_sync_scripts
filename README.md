# FFXIV_character_sync_scripts
Scripts to synchronise character uis

REMEMBER TO NEVERR RUN A SCRIPT YOU DOWNLOAD FROM THE INTERNET WITHOUT READING IT FIRST AND UNDERSTANDING WHAT IT DOES!

To use this script, download sync.php and the relevant run script for your operating system. Ensure PHP has been installed.
Ubuntu Linux: sudo apt install php
Arch: sudo pacman -S php
Fedora: sudo dnf install php
Windows: grab it from php.net

On Linux, Give the run-linux.sh script execute permissions (You did read it, right?), and place it in the same folder as your sync.php script. I recommand putting it under your home directory in a scripts sub directory.

Open your sync.php, and READ IT. I'm not going to go into what everything does, but you can look up the commands on php.net

Find 
$source = "/home/eevee/test/base";
$ffxiv = [
    "windows" => "/home/eevee/test/windows",
    "steam" => "/home/eevee/test/steam",
];

These are variables that point to your file locations. Change $source to a location where you can store your base directories, and create that directory.

For example
/home/eevee/Games/FFXIV

under this directory create \_baseui and screenshots.
/home/eevee/Games/FFXIV/\_baseui (Copy your main character's UI here)
/home/eevee/Games/FFXIV/screenshots

Point the other two paths to the correct locations for those installs. If you only have one, remove the other.

$ffxiv = [
    "windows" => "/home/eevee/Games/ffxiv-windows/pfx/drive_c/users/eevee/Documents/FINAL FANTASY XIV - A Realm Reborn",
];

Save sync.php and exit. 

Finally go to these folders and open any FFXIV_CHR0.... etcetcetc folder. These are your actual character data folders. Create a \_character.txt file inside and give that character a name. The \_character.txt file serves as both a label for that character, and a way to let the script know that folder is a character folder.

Finally, you are done. Go back to the location you saved the scripts. In Windows, you can double click the .bat file, and a Command Prompt should open up. 
On Linux, double click the run-linux.sh file and tell it to open in a terminal.


It should ask if you want to copy the hotbar.dat. After it has done this, it'll copy your screenshots to the screenshots folder, and copy your UI to each character. You are done.
