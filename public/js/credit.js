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
   if(parseInt(this.amount) < 500){
    alert("Maxmum borrowing please pay your loarn to proceed with this service");
   }else
   if(this.input.value > parseInt(this.amount)){
    alert(`you can not borrow greater than ${this.amount}`)
   }
   else{
    this.form.submit()
   }

    }
  }
}

new Withdraw(myForm,ourInput,amount)