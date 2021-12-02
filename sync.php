<?php
$source = "/home/snowy/test/base";
$ffxiv = [
    "windows" => "/home/snowy/test/windows",
    "steam" => "/home/snowy/test/steam",
];



// Do not edit anything below this line unless you want to change what the script does.

$isCLI = (php_sapi_name() == 'cli');
if(!$isCLI){
    echo "This script is designed to be run from the terminal only. Exiting.";
    exit;
}
$uhb = readline("Would you like to update the hotbars? Yes/No: ");
if($uhb != "Yes" && $uhb != "No"){
    echo "Invalid input detected. Answer must be Yes or No.";
    exit;

} else if ($uhb == "Yes"){
    $uhb = true;
} else {
    $uhb = false;
}

$forbidden = [
    "GEARSET.DAT",
    "ITEMFDR.DAT",
    "ITEMODR.DAT",
    "HOTBAR.DAT",
    "_character.txt",
];

CleanUp();
ScreenShots();

foreach($ffxiv as $type => $path) {
    if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if ('.' === $file) continue;
            if ('..' === $file) continue;
            

            $v = "$path/$file";
            if(is_writable($v) && file_exists("$v/_character.txt")){
                $character = file_get_contents("$v/_character.txt");
                echo "\e[1;32;40mNow copying $character to $v...\e[0m\n";
                if($uhb){
                    echo "Copying HOTBAR.DAT.source to HOTBAR.DAT...\n";
                    cp("$source/_baseui/HOTBAR.DAT.source","$v/HOTBAR.DAT");
                }
                CopyThat("$source/_baseui",$v); 
            }
        }
        closedir($handle);
    }
}

function CopyThat ($src,$dest){
    if ($handle = opendir($src)) {
        while (false !== ($file = readdir($handle))) {
            if ('.' === $file) continue;
            if ('..' === $file) continue;
            if ('HOTBAR.DAT.source' === $file) continue;
            $srcfile = "$src/$file";
            $destfile = "$dest/$file";
            cp($srcfile,$destfile);
        }
        closedir($handle);
    }
    
}
function cp ($srcfile,$destfile){
    if (!copy($srcfile, $destfile)) {
        $errors= error_get_last();
        echo "COPY ERROR: ".$errors['type']." " . $errors['message']."\n";
    } else {
        echo "$srcfile copied to $destfile!\n";
    }
}

function CleanUp(){
    global $source,$forbidden;
    $path = "$source/_baseui";
    if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if ('.' === $file) continue;
            if ('..' === $file) continue;

            $v = "$path/$file";
            foreach($forbidden as $test){
                if($file == $test){
                    if(is_writable($v)){
                        unlink($v);
                    } else {
                        echo "Error: $v is a forbidden file but can't be removed.";
                        exit;
                    }
                }
            }
        }
        closedir($handle);
    }
}
function ScreenShots(){
    global $source,$ffxiv;
    $dest = "$source/screenshots";
    if(!is_writable($dest)){
        echo "Screenshots destination is not writable!";
        return;
    }
    foreach($ffxiv as $type => $path) {
        if ($handle = opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if($file === "screenshots"){
                    $v = "$path/$file";
                    if ($handle2 = opendir($v)) {
                        while (false !== ($file2 = readdir($handle2))) {
                            if ('.' === $file2) continue;
                            if ('..' === $file2) continue;
                            $ss = "$v/$file2";
                            if(!rename($ss,"$dest/$file2")){
                                $errors= error_get_last();
                                echo "MOVE ERROR: ".$errors['type']." " . $errors['message']."\n";
                            } else {
                                echo "$ss moved to $dest/$file2!\n";
                            }
                            
                                
            
                        }
                        closedir($handle2);
                    }
                    
                }

            }
            closedir($handle);
        }
    }

}