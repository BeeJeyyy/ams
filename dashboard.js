function showSection(section) {
    document.getElementById('dashboard_section').style.display = "none";
    document.getElementById('add_admin_section').style.display = "none";
    document.getElementById('admin_list_section').style.display = "none";

    document.getElementById(section).style.display = "block";
}