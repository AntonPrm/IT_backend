//Задание №1
//файл 1
<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <title>проверка года</title>
  <style>
   #msg { 
    color: red; /* Цвет текста */ 
    display: none; /* Прячем сообщение */
   }
  </style>
  <script>
   function validForm(f) {
    // Если введено число, то скрываем предупреждение
    if (isDigit(f.value)) {document.getElementById("msg").style.display = "none";
      if (f.value.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
        } 
        else {
            var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "check.php?q=" + f.value, true);
        xmlhttp.send();
                }
    }
    // В противном случае отображаем предупреждение
    else {
		document.getElementById("msg").style.display = "inline";
		document.getElementById("txtHint").innerHTML = "";
        }
    }
   // Функция по проверке, число введено или нет
   function isDigit(data) {
    var numStr="0123456789";
    var k = 0;
    for (i=0;i<data.length;i++) {
      thisChar = data.substring(i, i+1);
      if (numStr.indexOf(thisChar) != -1) k++;
    }
    if (k == data.length) return 1;
    else return 0;
   }
  </script>
  
 </head>
 <body>
      <p>Проверка високосности года</p>  
  <form action="">

   <p><input type="int" onkeyup="validForm(this)"> 
      <span id="msg">ОШИБКА ВО ВХОДНЫХ ДАННЫХ</span></p>
  </form>
  <p>этот год високосный? <span id="txtHint"></span></p>

 </body>
</html>

// файл 2 
// check.php
<?php
//проверка года на високосность
$q = $_REQUEST["q"];

$hint = "";
   if ($q%4 != 0 || $q%100 == 0 && $q%400 != 0) {
		echo $hint === "" ? "НЕТ" : $hint;
		}
   elseif ($q%4 == 0 || $q%100 != 0 && $q%400 == 0) {
		echo $hint === "" ? "ДА" : $hint;
		}
   else {
		echo $hint === "" ? "ОШИБКА" : $hint;
		}

?>