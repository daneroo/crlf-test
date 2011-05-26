# CRLF issues
There is a git-config property: `core.autocrlf`, which affects how line endings are treated when interacting with a git repo.


## Detection
I used the `file` program under OSX. e.g.:

    dirac:crlf-test(master) daniel$ file Lorem-*
    Lorem-dos.txt:  ASCII text, with CRLF line terminators
    Lorem-unix.txt: ASCII text

## Tools
On OSX I installed `dos2unix` tools with

    sudo port install dos2unix