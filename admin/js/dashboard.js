function showSection(section) {
    let sections = [
        'dashboard_section',
        'add_teacher_section',
        'teacher_list_section',
        'add_class_section',
        'class_list_section',
        'add_section_section',
        'section_list_section',
        'add_student_section',
        'student_list_section',
        'schedules_section',
        'settings_section'
    ];

    sections.forEach(id => {
        let element = document.getElementById(id);
        if (element) element.style.display = "none";
    });

    let activeSection = document.getElementById(section);
    if (activeSection) activeSection.style.display = "block";
}