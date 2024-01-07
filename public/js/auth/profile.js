const deleteAccountForm = document.getElementById('delete-account-form');
const deleteAccountBtn = document.getElementById('delete-account-btn');

const handleDeleteAccount = async (e) => {
    const res = await Swal.fire({
        title: 'Estás seguro de eliminar tu cuenta?',
        text: 'Esta acción no se puede deshacer',
        icon: 'warning',
        showCancelButton: true,
    });
    if(res.isConfirmed) {
        deleteAccountForm.submit();
    }
}

deleteAccountBtn.addEventListener('click', (e) => {
    console.log('delete account');
    handleDeleteAccount(e)
});