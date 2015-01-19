// JavaScript Document
<!--
// Delete item
function removeItem(item)
{
    var answer = confirm ('Weet u zeker dat u dit product wilt verwijderen?')
    if (answer)
        window.location='Del_item.php?item=' + item;
}

// Delete all products
function removeCart()
{
    var answer = confirm ('Weet u zeker dat u de winkelwagen wilt leeghalen?')
    if (answer)
        window.location='Del_all.php';
}

// Submit form bij enter
// BRON: (http://www.htmlcodetutorial.com/forms/index_famsupp_157.html)
function submitenter(myfield,e)
{
    var keycode;
    if (window.event) keycode = window.event.keyCode;
    else if (e) keycode = e.which;
    else return true;

    if (keycode == 13)
    {
        myfield.form.submit();
        return false;
    }
    else
        return true;
}
//--> 