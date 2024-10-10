function validasi() {

    var nama = document.getElementById("nama").value;
    var email = document.getElementById("email").value;
    var nama = document.getElementById("alamat").value;

    if (nama === "" || email === "" || alamat === "") {
        alert("Semua data harus diisi.");
        return false;
    } 

    alert("ANJAYYYY bisa");

    return true;
}