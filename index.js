document.querySelector("#Pervious").addEventListener("click",HandleP);
document.querySelector("#Next").addEventListener("click",HandleN);

function HandleP()
{
    window.location.href=`previous.php?`;
}
function HandleN()
{
    window.location.href=`next.php?`;
}

