## Solution - for now
We will use `core.autocrlf=input` on Windows, and default setting on OSX.
Remains to be seen what we should do with newly created files on windows which will no doubt be created with CRLF
## CRLF issues
There is a git-config property: `core.autocrlf`, which affects how line endings are treated when interacting with a git repo.


## Detection
Wrote a php util: `count.php` to sniff line endings

    dirac:crlf-test(master) daniel$ php count.php count.php Lorem-*
    count.php endings: {"LF":68,"TOTAL":68}
    Lorem-dos.txt endings: {"CRLF":14,"TOTAL":14}
    Lorem-unix.txt endings: {"LF":14,"TOTAL":14}

And ran it against `../Ekoforms`

    dirac:Ekoforms(master) daniel$ find . -name \*php -exec php ../crlf-test/count.php {} \;|grep CRLF
    ./lib/JSONRPC/Server/annotations/annotation_parser.php endings: {"CRLF":341,"LF":18,"TOTAL":359}
    ./lib/JSONRPC/Server/annotations/doc_comment.php endings: {"CRLF":129,"LAST_NOEOL":1,"TOTAL":130}
    ./lib/JSONRPC/Server/annotations.php endings: {"CRLF":325,"LF":81,"TOTAL":406}
    ./lib/QuestServer/Security.php endings: {"CRLF":317,"LAST_NOEOL":1,"TOTAL":318}
    ./lib/QuestServer/Service.php endings: {"CRLF":1099,"LAST_NOEOL":1,"TOTAL":1100}
    ./web/_answer_functions.php endings: {"CRLF":270,"TOTAL":270}
    ./web/_country_list.php endings: {"CRLF":210,"LAST_NOEOL":1,"TOTAL":211}
    ./web/_province_list.php endings: {"CRLF":170,"LAST_NOEOL":1,"TOTAL":171}
    ./web/_quest_render.php endings: {"CRLF":119,"TOTAL":119}
    ./web/_scripts.php endings: {"CRLF":40,"LAST_NOEOL":1,"TOTAL":41}
    ./web/api.php endings: {"CRLF":125,"LAST_NOEOL":1,"TOTAL":126}
    ./web/Classes/PHPExcel/CachedObjectStorage/APC.php endings: {"CRLF":218,"TOTAL":218}
    ./web/Classes/PHPExcel/CachedObjectStorage/CacheBase.php endings: {"CRLF":172,"TOTAL":172}
    ./web/Classes/PHPExcel/CachedObjectStorage/DiscISAM.php endings: {"CRLF":157,"TOTAL":157}
    ./web/Classes/PHPExcel/CachedObjectStorage/Memcache.php endings: {"CRLF":236,"TOTAL":236}
    ./web/Classes/PHPExcel/CachedObjectStorage/Memory.php endings: {"CRLF":98,"TOTAL":98}
    ./web/Classes/PHPExcel/CachedObjectStorage/MemoryGZip.php endings: {"CRLF":107,"TOTAL":107}
    ./web/Classes/PHPExcel/CachedObjectStorage/MemorySerialized.php endings: {"CRLF":107,"TOTAL":107}
    ./web/Classes/PHPExcel/CachedObjectStorage/PHPTemp.php endings: {"CRLF":157,"TOTAL":157}
    ./web/Classes/PHPExcel/CachedObjectStorage/Wincache.php endings: {"CRLF":230,"TOTAL":230}
    ./web/Classes/PHPExcel/CachedObjectStorageFactory.php endings: {"CRLF":130,"LAST_NOEOL":1,"TOTAL":131}
    ./web/Classes/PHPExcel/Reader/Excel2007.php endings: {"LF":1668,"CRLF":9,"TOTAL":1677}
    ./web/Classes/PHPExcel/Reader/Excel5.php endings: {"CRLF":6443,"TOTAL":6443}
    ./web/Classes/PHPExcel/Shared/OLE/PPS/Root.php endings: {"LF":451,"CRLF":5,"TOTAL":456}
    ./web/Classes/PHPExcel/Shared/PDF/fonts/almohanad.php endings: {"CRLF":102,"TOTAL":102}
    ./web/Classes/PHPExcel/Shared/PDF/fonts/arialunicid0-chinese-simplified.php endings: {"CRLF":1744,"LF":24,"TOTAL":1768}
    ./web/Classes/PHPExcel/Shared/PDF/fonts/arialunicid0-chinese-traditional.php endings: {"CRLF":1744,"LF":24,"TOTAL":1768}
    ./web/Classes/PHPExcel/Shared/PDF/fonts/arialunicid0-japanese.php endings: {"CRLF":1744,"LF":24,"TOTAL":1768}
    ./web/Classes/PHPExcel/Shared/PDF/fonts/arialunicid0-korean.php endings: {"CRLF":1744,"LF":24,"TOTAL":1768}
    ./web/Classes/PHPExcel/Shared/PDF/fonts/arialunicid0.php endings: {"CRLF":1769,"TOTAL":1769}
    ./web/Classes/PHPExcel/Shared/PDF/fonts/symbol.php endings: {"CRLF":32,"TOTAL":32}
    ./web/Classes/PHPExcel/Shared/PDF/fonts/utils/makeallttffonts.php endings: {"CRLF":69,"TOTAL":69}
    ./web/Classes/PHPExcel/Shared/PDF/fonts/zapfdingbats.php endings: {"CRLF":32,"TOTAL":32}
    ./web/Classes/PHPExcel/Shared/PDF/fonts/zarbold.php endings: {"CRLF":47,"TOTAL":47}
    ./web/executeReport.php endings: {"CRLF":164,"LAST_NOEOL":1,"TOTAL":165}
    ./web/lib/jEko/data/imglist.php endings: {"CRLF":61,"LAST_NOEOL":1,"TOTAL":62}
    ./web/lib/jEko/data/upload-file.php endings: {"CRLF":11,"LAST_NOEOL":1,"TOTAL":12}
    ./web/lib/jEko/dist/style/ckeditor-3.3.1/ckeditor.php endings: {"CRLF":29,"TOTAL":29}
    ./web/lib/jEko/dist/style/ckeditor-3.3.1/ckeditor_php4.php endings: {"CRLF":593,"TOTAL":593}
    ./web/lib/jEko/dist/style/ckeditor-3.3.1/ckeditor_php5.php endings: {"CRLF":583,"TOTAL":583}
    ./web/lib/jEko/style/ckeditor-3.3.1/ckeditor.php endings: {"CRLF":29,"TOTAL":29}
    ./web/lib/jEko/style/ckeditor-3.3.1/ckeditor_php4.php endings: {"CRLF":593,"TOTAL":593}
    ./web/lib/jEko/style/ckeditor-3.3.1/ckeditor_php5.php endings: {"CRLF":583,"TOTAL":583}
    ./web/lib/jEko/test/data/annotations/annotation_parser.php endings: {"CRLF":341,"LF":18,"TOTAL":359}
    ./web/lib/jEko/test/data/annotations/doc_comment.php endings: {"CRLF":129,"LAST_NOEOL":1,"TOTAL":130}
    ./web/lib/jEko/test/data/annotations.php endings: {"CRLF":325,"LF":81,"TOTAL":406}
    ./web/login.php endings: {"CRLF":114,"LAST_NOEOL":1,"TOTAL":115}

I also used the `file` program under OSX. e.g.:

    dirac:crlf-test(master) daniel$ file Lorem-*
    Lorem-dos.txt:  ASCII text, with CRLF line terminators
    Lorem-unix.txt: ASCII text

## Tools
On OSX I installed `dos2unix` tools with

    sudo port install dos2unix