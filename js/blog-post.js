const inpTitle = document.querySelector("#Title")
const inpContent = document.querySelector("#content")

const add_post_btn = document.getElementById("add_post")

const msg = document.querySelector("#msg-span")

add_post_btn.addEventListener('click',async (e)=>{
    e.preventDefault();
    if(inpTitle.value === '' || inpContent.value === '') {
        msg.textContent = 'Fill the Title or post details'
        msg.style.opacity = 1
        setTimeout(()=>{
            msg.style.opacity = 0
        }, 3000)
        return;
    }
    if (document.querySelector('[type=file]').files.length === 0) {
        msg.textContent = 'Choose photo to blog'
        msg.style.opacity = 1
        setTimeout(()=>{
            msg.style.opacity = 0
        }, 3000)
        return;
    }

    const file = document.querySelector('[type=file]').files[0];

    const formData = new FormData();
    formData.append('file', file);
    formData.append('action', 'addPost')
    formData.append('post_name',inpTitle.value)
    formData.append('post_content',inpContent.value)

  try {
    const response = await fetch('/mini_blog/api.php',{
        body: formData,
        method:'post'
    });

    const result = await response.json();

    if(result.status){ 
        msg.textContent = result['data']
        msg.style.opacity = 1
        setTimeout(()=>{
            msg.style.opacity = 0
        }, 3000)
        return console.log(result['data']);
    } } catch(error){
        console.log(error);
    }
});