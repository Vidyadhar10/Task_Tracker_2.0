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
function GetTimeNow(Timestring) {
  var dateString = Timestring;
  var timestamp = moment(dateString).unix();

  // Calculate the time difference in seconds
  var timeDifference = moment().unix() - timestamp;

  // Calculate the time difference in minutes, hours, and days
  var minutes = Math.floor(timeDifference / 60);
  var hours = Math.floor(timeDifference / 3600);
  var days = Math.floor(timeDifference / 86400);

  // Format the relative time string
  var relativeTime = "";
  if (days > 0) {
    relativeTime = days + " days ago";
  } else if (hours > 0) {
    relativeTime = hours + " hrs. ago";
  } else if (minutes > 0) {
    relativeTime = minutes + " mins. ago";
  } else {
    relativeTime = "Just now";
  }

  return relativeTime;
}
ShowNotifications()

function ShowNotifications() {
  $.ajax({
    url: `./php/GetNotificationData.php`,
    type: 'GET',
    dataType: "JSON",
    success: function (data) {
      $('.NotifCount').html(data.NotificationCount);
      $('#noti_count').attr('data-target', data.NotificationCount);
      // console.log(data.NotiTableData);
      $('#AllNotificationsTabDiv').empty()
      $.each(data.NotiTableData, function (index, item) {
        var notificationString = `<div class="text-reset notification-item d-block dropdown-item position-relative">
                                      <div class="d-flex">
                                        <div class="avatar-xs me-3">
                                          <span class="avatar-title bg-soft-danger text-danger rounded-circle fs-16">
                                            <i class='${item.ActivityIcon}'></i>
                                          </span>
                                        </div>
                                        <div class="flex-1">
                                          <a href="#!" class="stretched-link">
                                            <h6 class="mt-0 mb-1 fs-13 fw-semibold">${item.ActivityTitle}</h6>
                                          </a>
                                          <div class="fs-13 text-muted">
                                            <p class="mb-1">${item.ActivityText}</p>
                                          </div>
                                          <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                            <span><i class="mdi mdi-clock-outline"></i> ${GetTimeNow(item.ActivityTime)}</span>
                                          </p>
                                        </div>
                                      </div>
                                    </div>`;
        $('#AllNotificationsTabDiv').append(notificationString);
      })
      var BtnString = `<div class="my-3 text-center view-all">
                            <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                              All Notifications <i class="ri-arrow-right-line align-middle"></i>
                            </button>
                          </div>`;
      $('#AllNotificationsTabDiv').append(BtnString);
    }
  })

}