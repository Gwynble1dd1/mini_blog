const inpUser = document.querySelector("#inputUsername")
const inpPassword = document.querySelector("#inputFirstName")
const inpDesc = document.querySelector("#inputUserDesc")

const name_btn = document.getElementById("upd_name")
const pass_btn = document.getElementById("upd_pass")
const desc_btn = document.getElementById("upd_desc")

const msg = document.querySelector("#msg-span")
const img = document.querySelector("#content > div > div.row > div.col-xl-4 > div > div.card-body.text-center > img")

name_btn.addEventListener('click',async (e)=>{
    e.preventDefault();
    if(inpUser.value === '') {
        msg.textContent = 'Fill the user name details'
        msg.style.opacity = 1
        setTimeout(()=>{
            msg.style.opacity = 0
        }, 3000)
        return;
    }
    const result =  await fetchhelper('/mini_blog/api.php','post',undefined,{
        username:inpUser.value,
        action:"updateUsername"
    })
    if(result['status']) return console.log(result['data'])//return window.location = 'blog.php'
    msg.textContent = result['data']
    msg.style.opacity = 1
    setTimeout(()=>{
        msg.style.opacity = 0
    }, 3000)
})

pass_btn.addEventListener('click',async (e)=>{
  e.preventDefault();
  console.log(inpPassword.value);
  if(inpPassword.value === '') {
      msg.textContent = 'Fill the password details'
      msg.style.opacity = 1
      setTimeout(()=>{
          msg.style.opacity = 0
      }, 3000)
      return;
  }
  const result =  await fetchhelper('/mini_blog/api.php','post',undefined,{
      password:inpPassword.value,
      action:"updatePassword"
  })
  if(result['status']){ 
    
    msg.textContent = result['data']
    msg.style.opacity = 1
    setTimeout(()=>{
        msg.style.opacity = 0
    }, 3000)
    return console.log(result['data'])//return window.location = 'blog.php'
  }})

desc_btn.addEventListener('click',async (e)=>{
  e.preventDefault();
  if(inpDesc.value === '') {
      msg.textContent = 'Fill the description'
      msg.style.opacity = 1
      setTimeout(()=>{
          msg.style.opacity = 0
      }, 3000)
      return;
  }
  const result =  await fetchhelper('/mini_blog/api.php','post',undefined,{
      userDesc:inpDesc.value,
      action:"updateDescription"
  })
  if(result['status']) {
  msg.textContent = result['data']
  msg.style.opacity = 1
  setTimeout(()=>{
      msg.style.opacity = 0
  }, 3000)
  return console.log(result['data'])//return window.location = 'blog.php'
}})

msg.addEventListener('click',()=>{
    msg.style.opacity = 0
})

const dropzone = document.querySelector('#content-wrapper');

dropzone.addEventListener('dragover', (event) => {
    event.preventDefault();
    dropzone.classList.add('dragover');
  });
  
  dropzone.addEventListener('dragleave', (event) => {
    event.preventDefault();
    dropzone.classList.remove('dragover');
  });
dropzone.addEventListener('drop', async (event) => {
    event.preventDefault();
    
    
    const file = event.dataTransfer.files[0];
    
    const formData = new FormData();
    formData.append('image', file);
    formData.append('action', 'Upload'); // add action parameter
    
    try {
      const response = await fetch('/mini_blog/api.php', { // update URL
        method: 'POST',
        body: formData
      });
      
      const result = await response.json();
      console.log(result);
      
      if (result.status) {
        const msgSpan = document.querySelector('#msg-span');
        msgSpan.innerHTML = 'Image uploaded successfully';
        msgSpan.style.backgroundColor = 'green';
        msgSpan.style.opacity = '1';
        img.src = result.img
        setTimeout(() => {
          msgSpan.style.opacity = '0';
        }, 3000);
      } else {
        alert('Error uploading image');
      }
    } catch (error) {
      console.log(error);
    }
  });
  
