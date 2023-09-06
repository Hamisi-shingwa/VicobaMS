class Banking{
    constructor(){
        this.photo = document.querySelector('.photo');
        this.filePhoto = document.getElementById('photo');
        this.docuElement = document.querySelector('.document-element')
        this.fileDoc = document.getElementById('document')
        this.urlElement = document.querySelector('.images')
        this.handleFileDisplay()
        this.handleURL(this.fileDoc)
        this.handleURL(this.filePhoto)
        console.log(this.photo)
       this.handleDeposite()
     
    }
    handleFileDisplay(){
      if(this.photo){
        this.filePhoto.style.display = "none"
        this.photo.onclick =()=>this.filePhoto.click();
      }

      if(this.docuElement){
        this.fileDoc.style.display = "none";
        this.docuElement.onclick = ()=>this.fileDoc.click()
      }
    }

    handleURL(file){
    if(file){
      file.onchange = (e)=>{
        const ourfile = e.target.files[0];
        const newpath = URL.createObjectURL(ourfile)
     
        if(file.id=="document"){
         this.urlElement.querySelector('img').src = newpath
        }
        else 
        if(file.id=="photo"){
         this.photo.querySelector('.profile-img').querySelector('img').src = newpath
        }
          }
    }
    }

   async handleDeposite(){
    const response = await fetch("../../banking/users/users.php");
    const datas = await response.json()
     const accountForm = document.getElementById('account-form');
     const transactionForm = document.querySelector('.transaction-details');
     const hasdeposite = document.querySelector('.hasdeposite');


     transactionForm ? accountForm.style.display = "none" : ""
     hasdeposite ? transactionForm.style.display = "none": ""

     if(accountForm){
         const accountNumber = accountForm.querySelector('#account-input');
         const notavailable = document.querySelector('.notavailable');
   
         if(notavailable){
          accountNumber.oninput = ()=> notavailable.style.display = "none"
         }   
     }
 
     if(transactionForm){
      transactionForm.onsubmit = (e)=>{
      e.preventDefault();
      const inputValue = transactionForm.querySelector('#transaction_input').value
      if(inputValue < 500){
        alert("You can not deposite null amount or less than 500 Tsh");
      }
      else{
        transactionForm.submit()
      }

      }
     }
    }

    
}
new Banking()
console.log("Hellow")