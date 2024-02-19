# Money-Management-Page
This project is a dynamic web application designed to provide users with a robust set of functionalities. From user registration and login to transaction management, the application streamlines essential tasks within a sleek and intuitive interface.

<p align="center">
  <img src="https://i.imgur.com/o3wF5uA.png" width=100%>
</p>

<p align="center">
  <img src="https://i.imgur.com/elwJWh1.png" width=100%>
</p>  

<p align="center">
  <img src="https://i.imgur.com/NYyNQMu.png" width=100%>
</p>

## Features

### 1. User Registration and Login
The project includes a user registration and login system. The JavaScript code ensures that users provide necessary information during registration, such as a username, password, and email. The login functionality utilizes XMLHttpRequest for server-side communication.

### 2. Navigation
The navigation system is user-friendly, with a responsive hamburger menu for mobile devices. The JavaScript function `handleNav` toggles the mobile navigation, allowing smooth transitions and enhancing the overall user experience.

### 3. Year Display
The application dynamically displays the current year in the footer. The `handleCurrentYear` function ensures that users always see the up-to-date year.

### 4. Plans Modal
A modal feature showcases different plans, including silver, gold, and diamond options. The `showModal` function manages the modal's visibility and highlights the selected plan.

### 5. Add Transaction Panel
The application facilitates the management of transactions through an add transaction panel. Users can input transaction details, and the `checkForm` function ensures all required fields are filled before processing.

### 6. Change Password
Users can change their passwords through a dedicated form. The `showMessage` function communicates with the server-side PHP script (`zmiana_hasla.php`) to update passwords securely.

### 7. Sidebar
The sidebar, toggled by the menu button, enhances navigation. The JavaScript code `menuBtnChange` ensures the menu button icon updates according to the sidebar state.

### 8. Login Form
An additional login form enhances the project's versatility, providing users with alternative authentication options.

### 9. Clear Form Button
The 'Clear Form' button in the user registration form (`clearBtn`) resets all input fields, providing users with a convenient way to start afresh.
