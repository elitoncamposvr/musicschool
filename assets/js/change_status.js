const checkboxStatus = document.querySelector('#status');

let changeStatus = () => {
    if(checkboxStatus.checked){
        checkboxStatus.value = '1';
    } else{
        checkboxStatus.value = '0'
    }
}

checkboxStatus.addEventListener('click', changeStatus);