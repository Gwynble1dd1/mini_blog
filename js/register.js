/*
    global variables
*/

const inpUser = document.querySelector("#name")
const inpPassword = document.querySelector("#password")
const confirmPass = document.querySelector("#confirmPassword")
const btn = document.querySelector("#btnR")
const msg = document.querySelector("#msg-span")

btn.addEventListener('click',async (e)=>{
    e.preventDefault();
    if(inpPassword.value =='' || inpPassword.value !== confirmPass.value ||  inpUser.value =='') {
        msg.textContent = 'username/password filed empty or do not equal to Confirm Password'
        msg.style.opacity = 1
        setTimeout(()=>{
            msg.style.opacity = 0
        }, 3000)
        return;
    }
    const result =  await fetchhelper('/mini_blog/api.php','post',undefined,{
        username:inpUser.value,
        password:inpPassword.value,
        action:"register"
    })
    if(result['status'])return window.location = 'login.php'
    msg.textContent = result['data']
    msg.style.opacity = 1
    setTimeout(()=>{
        msg.style.opacity = 0
    }, 3000)
})

msg.addEventListener('click', ()=> msg.style.opacity = 0)

