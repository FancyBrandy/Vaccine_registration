// Sending a new appointment
var c = document.getElementById("Versicherung");
const b = document.getElementById("confirm");
window.onload= function(){  
    
    const message=document.getElementById("error");
    c.onclick = function(){
       
       console.log(c.checked);
       if (c.checked === false)
        {
            message.style.display="block";
            message.style.color="red";
            b.disabled=true;
        }
      else
        {
            message.style.display="none";
          
            b.disabled=false;
            
        }			 
    }
  }
  
    
 b.addEventListener("click",handleButtonClick);
  
 
  async function handleButtonClick() {
    // Get the ID of the topic from the URL (navigation bar)
    const urlSearchParams = new URLSearchParams(location.search);
    const topicId = urlSearchParams.get("id");
    window.location.href=`successfulbooking.php?id=${topicId}`;
  
  
    const formData = new FormData();
    formData.append("topicId", topicId);
  
    // Sending the form information to the server
    const response = await fetch("api/create-post.php", {
      method: "POST",
      body: formData,
    });
  
  }
  
  
  
  