const form = document.querySelector('form')
const errorElement = document.querySelector('.show')
const circleElement = document.querySelector('.circle-element')


class FormValidator{
    constructor(form, errorElement,cirlce){
        this.form = form
        this.displayErr = errorElement
        this.cirlce = cirlce
        this.submit = document.getElementById('submit')
        this.showSubmit = document.querySelector('.show-submit')
        this.handleFeedBackElement()
        this.handleCircle()
    }

    handleFeedBackElement(){
       
      if(this.displayErr){
        this.cirlce.style.display = "none"
        const formInputs = this.form.querySelectorAll('input')
        formInputs.forEach(input=>{
            input.oninput = ()=>{
                errorElement.style.display = "none";
                this.cirlce.style.display = "none"
                if(this.form.id ==="reg"){
                  console.log("Id is reg")
                  this.showSubmit.textContent="Register"
                }
                else  this.showSubmit.textContent="Login"
            }
        })
      }
    }

    handleCircle(){
      this.showSubmit.onclick = (e)=>{
        this.cirlce.style.display = "grid"
        if( this.cirlce.style.display = "grid") this.showSubmit.textContent=""

        setTimeout(()=>{
          this.submit.click()
        },1000)
      }
    }
}

new FormValidator(form, errorElement,circleElement)