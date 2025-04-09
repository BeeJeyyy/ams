function showStudentList(id) {
  // Hide all student lists
  const allStudentLists = document.querySelectorAll('.student-details');
  allStudentLists.forEach(el => el.style.display = 'none');

  // Show the selected one
  const selected = document.getElementById(id);
  if (selected) {
    selected.style.display = 'block';
  }
}

function hideStudentList(id) {
  const section = document.getElementById(id);
  if (section) {
    section.style.display = 'none';
  }
}