/*
    global variables
*/

const inpUser = document.querySelector("#email")
const inpPassword = document.querySelector("#password")
const btn = document.querySelector("body > div > div > div > div > div > div > div > div > form > button")
const msg = document.querySelector("#msg-span")

btn.addEventListener('click',async (e)=>{
    e.preventDefault();
    if(inpPassword.value =='' ||  inpUser.value =='') {
        msg.textContent = 'username/password fileds are empty'
        msg.style.opacity = 1
        setTimeout(()=>{
            msg.style.opacity = 0
        }, 3000)
        return;
    }
    const result =  await fetchhelper('/mini_blog/api.php','post',undefined,{
        username:inpUser.value,
        password:inpPassword.value,
        action:"login"
    })
    if(result['status'])return window.location = 'blog.php'
    msg.textContent = result['data']
    msg.style.opacity = 1
    setTimeout(()=>{
        msg.style.opacity = 0
    }, 3000)
})

msg.addEventListener('click',()=>{
    msg.style.opacity = 0
})

