
	set tgl1=%date:~8,2%%date:~3,2%%date:~0,2%
	set jam1=%time:~0,2%%time:~3,2%
	for %%a in (.) do set xpath=%%~nxa
	set tgljam=%tgl1%%jam1%
	set zpfile=d:\backup\%xpath%%tgljam%.zip
	set dbfile=d:\backup\db\%xpath%%tgljam%.sql
	echo %tgljam%%xpath%
		set dbname=uji
	echo %dbname%
	rem  %zpfile%%dbfile%%xpath%
	"C:\database\MariaDB 10.4\bin\mysqldump" --port 3308 --databases --user=root --password=toor %dbname% > "%dbfile%"
	rem echo %zpfile%%tgl%%zpfile%
	rem 7z a -tzip "%zpfile%" application assets\js assets\css "%dbfile%"	
	7z a -tzip "%zpfile%" application\config application\controllers application\helpers application\views application\models assets\admin\css assets\css assets\admin\js assets\js "%dbfile%"	
	rem 7z a -tzip "%zpfile%" application\config application\controllers application\helpers application\models application\libraries application\views assets\js assets\css ai *.php .htaccess *.bat "%dbfile%"
