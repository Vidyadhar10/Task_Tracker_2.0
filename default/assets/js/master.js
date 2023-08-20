/**
 * Number input only function
**/
function InputNumberOnly(paraID) {
    var Numbers = $('#' + paraID).val();
    if (isNaN(Numbers)) {
        Numbers = Numbers.slice(0, -1);
        $('#' + paraID).val(Numbers);
    }
}
// document.getElementById("sa-warning").addEventListener("click", function () {
//     Swal.fire({
//         title: "Are you sure?",
//         text: "You won't be able to revert this!",
//         icon: "warning",
//         showCancelButton: !0,
//         confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
//         cancelButtonClass: "btn btn-danger w-xs mt-2",
//         confirmButtonText: "Yes, delete it!",
//         buttonsStyling: !1,
//         showCloseButton: !0
//     }).then(function (t) {
//         t.value && Swal.fire({
//             title: "Deleted!",
//             text: "Your file has been deleted.",
//             icon: "success",
//             confirmButtonClass: "btn btn-primary w-xs mt-2",
//             buttonsStyling: !1
//         })
//     })
// })