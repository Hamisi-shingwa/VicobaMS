const myForm = document.querySelector('.withdraw-form')
const ourInput = document.querySelector('#amount')
const amount = document.querySelector('.amount-withdraw').textContent

class Withdraw{
  constructor(form,input,amount){
  this.form = form
  this.input = input
  this.amount =amount
this.handleWithdraw()
  }

  handleWithdraw(){
    this.form.onsubmit = (e)=>{
      e.preventDefault();
   if(this.input.value != parseInt(this.amount)){
    alert(`please with draw all of your available amount which is Tsh ${this.amount}`)
   }
   else{
    this.form.submit()
   }

    }
  }
}

new Withdraw(myForm,ourInput,amount)