<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Notification </title>
    <link rel="stylesheet" href="notify.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .wrapper {
            max-width: 600px;
            margin: 0 auto;
        }

        .notification_wrap {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
        }

        .notification_icon {
            margin-right: 10px;
            color: #605dff;
            font-size: 24px;
        }

        .notification_icon .fa-bell {
            cursor: pointer;
        }

        .dropdown {
            position: relative;
        }

        .dropdown.active {
            display: block;
        }

        .dropdown.active .notification_list {
            display: block;
        }

        .notification_list {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            min-width: 200px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .notify_item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .notify_item:last-child {
            border-bottom: none;
        }

        .notify_info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notify_info p {
            margin: 0;
            font-weight: bold;
            color: #333;
        }

        .notify_time {
            font-size: 12px;
            color: #999;
        }

        .active {
            width: 10px;
            height: 10px;
            background-color: lightgreen;
            border-radius: 50%;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.4s;
            display: none;
        }

        .delete {
            cursor: pointer;
            display: inline-block;
            margin-left: 10px;
            color: #999;
            font-size: 16px;
        }

        .delete:hover {
            color: #ff6347;
        }

        .setting-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .setting-icon img {
            width: 20px;
            height: 20px;
        }

        .categories-container {
            display: none;
            padding: 10px;
        }

        .category-checkbox {
            visibility: hidden;
        }

        .category-checkbox+label {
            cursor: pointer;
            display: block;
            margin-bottom: 5px;
        }

        .showNotification {
            display: block !important;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <div class="notification_wrap">
            <div class="notification_icon">
                <i class="fas fa-bell"></i>
            </div>
            <div class="dropdown">
                <p id="log-msg">You have successfully logged in!!!</p>

                <div class="setting-icon" onclick=notify_settings()>
                    <img src="setting-gear.jpeg" alt="settings">
                </div>

                <table id="notify-settings">
                    <tr>
                        <td class="switch">
                            Notifications
                            <input type="checkbox" id="toggle" onchange="toggleCategories()" />
                            <label for="toggle"></label>
                        </td>
                    </tr>
                    <tr>
                        <td class="categories-container">
                            Patients
                            <input type="checkbox" class="category-checkbox" id="patients" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Sample data for patient notifications
        let patientNotificationData = [
            { notificationTitle: "New Appointment Request", notificationContent: "You have a new appointment request from a patient yoginilande." },
            { notificationTitle: "Appointment Reminder", notificationContent: "Your appointment is scheduled for tomorrow at 10:00 AM." }
        ];

        document.addEventListener('DOMContentLoaded', function () {
            var bellIcon = document.querySelector(".notification_icon .fa-bell");
            bellIcon.addEventListener('click', function () {
                var dropdown = document.querySelector(".dropdown");
                dropdown.classList.toggle("active");
            });
        });

        function activeNotify(e) {
            e.querySelector(".active").style.display = "none";
        }

        for (let i = 0; i < patientNotificationData.length; i++) {
            document.querySelector(".dropdown").innerHTML += `<div class="notify_item" onclick="activeNotify(this)">
			<div class="notify_info">
				<p>${patientNotificationData[i].notificationTitle}</p>
				<span class="notify_time">10 minutes ago</span>
                <p>${patientNotificationData[i].notificationContent}</p>
			</div>
			<div class="active"></div>
			<div class="delete" onclick="deleteNotifaction(${i}, this)">
				<div class="icon-container">
					<i class="fas fa-trash-alt"></i>
				</div>
			</div>
		</div>`;
        }

        function notify_settings() {
            document.getElementById("notify-settings").classList.toggle('showNotification');
        }

        function deleteNotifaction(notificationNumber, deleteButton) {
            patientNotificationData.splice(notificationNumber, 1);
            console.log(patientNotificationData);
            console.log(deleteButton);
            deleteButton.parentElement.style.opacity = '0';
            setTimeout(() => {
                deleteButton.parentElement.style.height = '0'
                deleteButton.parentElement.style.padding = '0'
            }, 350);
            setTimeout(() => {
                deleteButton.parentElement.style.display = 'none'
            }, 2000);
        }

        function toggleCategories() {
            var toggleCheckbox = document.getElementById("toggle");
            var categoryCheckboxes = document.querySelectorAll(".categories-container");
            if (toggleCheckbox.checked) {
                categoryCheckboxes.forEach(function (checkbox) {
                    checkbox.style.display = "block";
                });
            } else {
                categoryCheckboxes.forEach(function (checkbox) {
                    checkbox.style.display = "none";
                });
            }
        }
    </script>
</body>

</html>
