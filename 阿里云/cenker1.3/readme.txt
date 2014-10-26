cenker1.3版本较之前1.2版本有些修改和功能完善
完善部分:号码百事通，完成了号码百事通这个查询功能
在wechat_func.php里添加了getPhoneWithName($db,$name)这个函数，以及wechat_entry.php里添加了号码百事通处理代码

数据库:新建了号码表telphone，并且号码表中添加了一些新号码(比如教务办公室，学院办公室)

注意点:数据库必须使用cenker1.3版本数据库文件