

var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

try{
	var signupModalButton = document.getElementById('signup-modal-open-button');
	var signupModal = document.getElementById('signup-modal');
	var signupModalClose = document.getElementById('signup-modal-close-button');
	signupModalButton.onclick = function(){
		signupModal.style.display = 'block';
	}
	signupModalClose.onclick = function(){
		signupModal.style.display = 'none';
	}
}catch(e){
	console.log('Hell yeah');
}

try{
	var errorMessageBox = document.getElementById('error-messagebox');
	var errorMessageBoxClose = document.getElementById('error-messagebox-close-button');

	errorMessageBoxClose.onclick = function(){
		errorMessageBox.style.display = 'none';
		setTimeout(function(){
			window.location = baseUrl;
		}, 700);
	}
}catch(e){
	console.log("Bitchin ! :)");
}

try{
  var burger = document.querySelector('.burger');
  var nav = document.querySelector('#'+burger.dataset.target);
 
  burger.addEventListener('click', function(){
    burger.classList.toggle('is-active');
    nav.classList.toggle('is-active');
  });

}catch(e){
	console.log("its like a fffeling");
}

try{
	var addFacultyModalButton = document.getElementById('add-faculty-modal-open-button');
	var addFacultyModal = document.getElementById('add-faculty-modal');
	var addFacultyModalClose = document.getElementById('add-faculty-modal-close-button');
	addFacultyModalButton.onclick = function(){
		addFacultyModal.style.display = 'block';
	}
	addFacultyModalClose.onclick = function(){
		addFacultyModal.style.display = 'none';
	}
}catch(e){
	console.log('Open the door 3 inches minimum');
}



function SignIn(){
		var signindata = $('#signin-form').serialize();
		
		$.ajax({
			type : 'POST' ,
			data: signindata,
			url : baseUrl + '/api/signin',
			success : function(msg){
				console.log(msg);
				if ($.trim(msg) == 'empty' ) {
					swal('error','Please fill required fields','error');
				}else if($.trim(msg) == 'success'){
					swal('successful' , 'sign in successful' , 'success');
					setTimeout(function(){
					window.location = baseUrl;
					}, 700);
				}else if($.trim(msg) == 'unapproveduser'){
					swal('Unapproved user' , 'Please wait until approved by administrator ' , 'error');
				}else if($.trim(msg) == 'unsuccessful'){
					swal('unsuccessfull' , 'check your username and password and try again' , 'error');
				}else{
					swal('unsuccessfull' , 'something went wrong' , 'error');
				}
			}
		});
}

function SignUp(){
	var signupdata = $("#signup-form").serialize();

	$.ajax({
		type : 'POST',
		data : signupdata,
		url : baseUrl + '/api/signup',
		success: function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
					swal('Error','Please fill required fields','error');
				}else if($.trim(msg) == 'emailisnotvalid'){
					swal('Email is not valid' , 'Please type a valid email and try again' , 'error');			
				}else if($.trim(msg) == 'usedemail'){
					swal('Wrong email' , 'Email in use' , 'error');			
				}else if($.trim(msg) == 'unsupportedemail'){
					swal('Unsupported email' , 'Only bozok.edu.tr and yobu.edu.tr emails are supported' , 'error');			
				}else if($.trim(msg) == 'success'){
					swal('Successful' , 'Sign up successful' , 'success');
				}else{
					swal('Error' , 'Something went wrong please try again and report the error' , 'error');
				}
			}
	});
}

function AddFaculty(){
	var addfacultydata = $("#add-faculty-form").serialize();

	$.ajax({
		type : 'POST',
		data : addfacultydata,
		url : baseUrl + '/api/add/faculty',
		success: function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
					swal('Error','Please fill required fields','error');
				}else if($.trim(msg) == 'academicianerror'){
					swal('academician Not Exists' , 'Please select valid academician' , 'error');			
				}else if($.trim(msg) == 'facultycodeerror'){
					swal('Wrong Faculty Code' , 'Faculty code must be positive numeric and 4 digits long' , 'error');			
				}else if($.trim(msg) == 'facultycodeinuse'){
					swal('Wrong Faculty Code' , 'Faculty code in use' , 'error');			
				}else if($.trim(msg) == 'success'){
					swal('Successful' , 'Faculty added successfuly' , 'success');
						setTimeout(function(){
						window.location = baseUrl+'/faculties';
					}, 700);
				}else{
					swal('Error' , 'Something went wrong please try again and report the error' , 'error');
				}
			}
	});
}

function EditFaculty(id){
	
		var editfacultydata = {
			id : id
		};

		$.ajax({
			type : 'POST',
			data : editfacultydata,
			url : baseUrl + '/api/get/faculty',
			success : function(msg){
				if (msg == "error") {
					swal("error" , "Something went wrong try again and report error to us","error");
				}else{
					var faculty = JSON.parse(msg);
					var facultyCode = faculty.faculty_code;
					var facultyName = faculty.faculty_name;
					var facultyId = faculty.faculty_id;
					var deanName = faculty.academician_fullname;
					var deanId = faculty.academician_id;

					$('#edfacultycode').val(facultyCode);
					$('#edfacultyname').val(facultyName);
					$('#edfacultyid').val(facultyId);
					$('#edfacultydean').val(deanId);


					try{
						var editFacultyModal = document.getElementById('edit-faculty-modal');
						var editFacultyModalClose = document.getElementById('edit-faculty-modal-close-button');

						editFacultyModal.style.display = 'block';
						
						editFacultyModalClose.onclick = function(){
							editFacultyModal.style.display = 'none';
						}
					}catch(e){
						console.log('Open the door 3 inches minimum');
					}

				}
				
			}
		});

}

function UpdateFaculty(){
	var updatefacultydata = $('#edit-faculty-form').serialize();

	$.ajax({
		type : 'POST',
		data : updatefacultydata,
		url : baseUrl + '/api/update/faculty',
		success: function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
				swal('Error','Please fill required fields','error');
			}else if($.trim(msg) == 'deannotexists'){
				swal('Academician Not Exists' , 'Please select valid academician' , 'error');			
			}else if($.trim(msg) == 'facultycodeerror'){
				swal('Wrong Faculty Code' , 'Faculty code must be positive numeric and 4 digits long' , 'error');			
			}else if($.trim(msg) == 'facultycodeinuse'){
				swal('Wrong Faculty Code' , 'Faculty code in use' , 'error');			
			}else if($.trim(msg) == 'success'){
				swal('Successful' , 'Faculty updated successfuly' , 'success');
					setTimeout(function(){
						window.location = baseUrl+'/faculties';
				}, 700);
			}else{
				swal('Error' , 'Something went wrong please try again and report the error' , 'error');
			}
		}

	});

}

try{
	var addDepartmentModalButton = document.getElementById('add-department-modal-open-button');
	var addDepartmentModal = document.getElementById('add-department-modal');
	var addDepartmentModalClose = document.getElementById('add-department-modal-close-button');
	addDepartmentModalButton.onclick = function(){
		addDepartmentModal.style.display = 'block';
	}
	addDepartmentModalClose.onclick = function(){
		addDepartmentModal.style.display = 'none';
	}
}catch(e){
	console.log('Open the door 3 inches minimum');
}


function AddDepartment(){
	var adddepartmentdata = $('#add-department-form').serialize();

	$.ajax({
		type: 'POST',
		data : adddepartmentdata,
		url: baseUrl + '/api/add/department',
		success: function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
				swal('Error','Please fill required fields','error');
			}else if($.trim(msg) == 'academicianerror'){
				swal('Academician Not Exists' , 'Please select valid academician' , 'error');			
			}else if($.trim(msg) == 'departmentcodeerror'){
				swal('Wrong Department Code' , 'Department code must be positive numeric and 3 digits long' , 'error');			
			}else if($.trim(msg) == 'departmentcodeinuse'){
				swal('Wrong Department Code' , 'Department code in use' , 'error');			
			}else if($.trim(msg) == 'facultyerror'){
                swal('Wrong Faculty' , 'Faculty not exists' , 'error');         
            }else if($.trim(msg) == 'success'){
				swal('Successful' , 'Department added successfuly' , 'success');
					setTimeout(function(){
						window.location = baseUrl+'/departments';
				}, 700);
			}else{
				swal('Error' , 'Something went wrong please try again and report the error' , 'error');
			}
		}
	});
}

function EditDepartment(id){
    var editdepartmentdata = {
            id : id
        };

        $.ajax({
            type : 'POST',
            data : editdepartmentdata,
            url : baseUrl + '/api/get/department',
            success : function(msg){
                
                if (msg == 'error') {
                    swal('error' , 'Something went wrong try again and report error to us','error');
                }else{
                    var department = JSON.parse(msg);
                    var departmentId = department.department_id;
                    var facultyId = department.faculty_id;
                    var departmentCode = department.department_code;
                    var departmentName = department.department_name;
                    var facultyName = department.faculty_name;
                    var departmentHead = department.academician_fullname;
                    var departmentHeadId = department.academician_id;



                    $('#eddepartmentcode').val(departmentCode);
                    $('#eddepartmentname').val(departmentName);
                    $('#eddepartmentid').val(departmentId);
                    $('#eddepartmentfaculty').val(facultyId);
                    $('#eddepartmenthead').val(departmentHeadId);
    

                    try{
                        var editDepartmentModal = document.getElementById('edit-department-modal');
                        var editDepartmentModalClose = document.getElementById('edit-department-modal-close-button');

                        editDepartmentModal.style.display = 'block';
                        
                        editDepartmentModalClose.onclick = function(){
                            editDepartmentModal.style.display = 'none';
                        }
                    }catch(e){
                        console.log('Demogorgon');
                    }                 

                }
                
                
            }
        });
}

function UpdateDepartment(){
    var updatedepartmentdata = $("#edit-department-form").serialize();

    $.ajax({
        type : 'POST',
        data : updatedepartmentdata,
        url : baseUrl + '/api/update/department',
        success : function(msg){
            console.log(msg);
            if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'academicianerror'){
                swal('Academician Not Exists' , 'Please select valid academician' , 'error');           
            }else if($.trim(msg) == 'departmentcodeerror'){
                swal('Wrong Department Code' , 'Department code must be positive numeric and 3 digits long' , 'error');            
            }else if($.trim(msg) == 'departmentcodeinuse'){
                swal('Wrong Department Code' , 'Department code in use' , 'error');            
            }else if($.trim(msg) == 'facultyerror'){
                swal('Wrong Faculty ' , 'Faculty not exists' , 'error');            
            }else if($.trim(msg) == 'success'){
                swal('Successful' , 'Department updated successfuly' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/departments';
                }, 700);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
        }

    });
}

function EditStudent(id){
	var editstudentdata = {id : id};

	$.ajax({
		type : 'POST',
		data : editstudentdata,
		url: baseUrl+'/api/get/student',
		success: function(msg){
			console.log(msg);
			if(msg == "error"){
                swal('error' , 'Something went wrong try again and report error to us','error');
			}else{
				var student = JSON.parse(msg);
				var studentId = student.student_id;
				var studentName = student.student_fullname;
				var studentYear = student.student_year;
				var studentFaculty = student.faculty_id;
				var studentDepartment = student.department_id;
				var studentStatus = student.student_status;

				$('#edstudentname').val(studentName);
				$('#edstudentid').val(studentId);
				$('#edstudentyear').val(studentYear);
				$('#edstudentfaculty').val(studentFaculty);
				$('edstudentdepartment').val(studentDepartment);
				$('#edstudentstatus').val(studentStatus);


                 try{
                        var editStudentModal = document.getElementById('edit-student-modal');
                        var editStudentModalClose = document.getElementById('edit-student-modal-close-button');

                        editStudentModal.style.display = 'block';    
                        editStudentModalClose.onclick = function(){
                            editStudentModal.style.display = 'none';
                        }
                    }catch(e){
                        console.log('Demogorgon');
                    }                 
			}
		}
	});
}

function UpdateStudent(){

	var updatestudentdata = $('#edit-student-form').serialize();

	$.ajax({
		type : 'POST',
		data : updatestudentdata,
		url : baseUrl + '/api/update/student',
		success : function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'facultyerror'){
                swal('Faculty Error' , 'Please select valid faculty' , 'error');           
            }else if($.trim(msg) == 'departmenterror'){
                swal('Department Error' , 'Please select valid department' , 'error');            
            }else if($.trim(msg) == 'success'){
                swal('Successful' , 'Student updated successfuly' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/students';
                }, 700);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
		}
	});

}

function EditAcademician(id){
	var editacademiciandata = {id : id};

	$.ajax({
		type : 'POST',
		data : editacademiciandata,
		url: baseUrl+'/api/get/academician',
		success: function(msg){
			console.log(msg);
			if(msg == "error"){
                swal('error' , 'Something went wrong try again and report error to us','error');
			}else{
				var academician = JSON.parse(msg);
				var academicianId = academician.academician_id;
				var academicianName = academician.academician_fullname;
				var academicianFaculty = academician.faculty_id;
				var academicianDepartment = academician.department_id;
				var academicianStatus = academician.academician_status;

				$('#edacademicianname').val(academicianName);
				$('#edacademicianid').val(academicianId);
				$('#edacademicianfaculty').val(academicianFaculty);
				$('#edacademiciandepartment').val(academicianDepartment);
				$('#edacademicianstatus').val(academicianStatus);
        
                 try{
                        var editAcademicianModal = document.getElementById('edit-academician-modal');
                        var editAcademiciantModalClose = document.getElementById('edit-academician-modal-close-button');

                        editAcademicianModal.style.display = 'block';
                        
                        editAcademiciantModalClose.onclick = function(){
                            editAcademicianModal.style.display = 'none';
                        }
                }catch(e){
                        console.log('Demogorgon');
                }                 
			}
		}
	});
}

function UpdateAcademician(){
	var updateacademician = $('#edit-academician-form').serialize();
	$.ajax({
		type : 'POST',
		data : updateacademician,
		url : baseUrl + '/api/update/academician',
		success : function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'facultyerror'){
                swal('Faculty Error' , 'Please select valid faculty' , 'error');           
            }else if($.trim(msg) == 'departmenterror'){
                swal('Department Error' , 'Please select valid department' , 'error');            
            }else if($.trim(msg) == 'success'){
                swal('Successful' , 'Academician updated successfuly' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/academicians';
                }, 700);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
		}
	});

}

// date pickers
try{
    $( "#academicyearstartdate" ).datepicker({dateFormat: "yy-mm-dd", separator: "-"});
    $( "#academicyearenddate" ).datepicker({dateFormat: "yy-mm-dd", separator: "-"});
    $( "#edacademicyearstartdate" ).datepicker({dateFormat: "yy-mm-dd", separator: "-"});
    $( "#edacademicyearenddate" ).datepicker({dateFormat: "yy-mm-dd", separator: "-"});

    $( "#academictermstartdate" ).datepicker({dateFormat: "yy-mm-dd", separator: "-"});
    $( "#academictermenddate" ).datepicker({dateFormat: "yy-mm-dd", separator: "-"});
    $( "#edacademictermstartdate" ).datepicker({dateFormat: "yy-mm-dd", separator: "-"});
    $( "#edacademictermenddate" ).datepicker({dateFormat: "yy-mm-dd", separator: "-"});

    $( "#courseselectionstartdate" ).datepicker({dateFormat: "yy-mm-dd", separator: "-"});
    $( "#courseselectionenddate" ).datepicker({dateFormat: "yy-mm-dd", separator: "-"});
    $( "#edcourseselectionstartdate" ).datepicker({dateFormat: "yy-mm-dd", separator: "-"});
    $( "#edcourseselectionenddate" ).datepicker({dateFormat: "yy-mm-dd", separator: "-"});

}catch(e){
	console.log(e)
}
try{
	var addAcademicYearModalButton = document.getElementById('add-academic-year-modal-open-button');
	var addAcademicYearModal = document.getElementById('add-academic-year-modal');
	var addAcademicYearModalClose = document.getElementById('add-academic-year-modal-close-button');
	addAcademicYearModalButton.onclick = function(){
		addAcademicYearModal.style.display = 'block';
	}
	addAcademicYearModalClose.onclick = function(){
		addAcademicYearModal.style.display = 'none';
	}
}catch(e){
	console.log('Open the door 3 inches minimum');
}

function AddAcademicYear(){
	var addacademicyeardata = $('#add-academic-year-form').serialize();
	$.ajax({
		type : 'POST',
		data : addacademicyeardata,
		url : baseUrl +'/api/add/academicyear',
		success : function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'success'){
                swal('Successful' , 'Academic year added successfully' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/academicyear';
                }, 700);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
		}
	});
}

function EditAcademicYear(id){
	var editacademicyeardata = {id:id};
	$.ajax({
		type : 'POST',
		data : editacademicyeardata,
		url : baseUrl + '/api/get/academicyear',
		success : function(msg){
			console.log(msg);
		if (msg == 'error') {
                swal('error' , 'Something went wrong try again and report error to us','error');
		}else{
			var academicYear = JSON.parse(msg);
			var academicYearId = academicYear.academic_year_id;
			var academicYearName = academicYear.academic_year;
			var academicYearStartDate = academicYear.academic_year_start_date;
			var academicYearEndDate = academicYear.academic_year_end_date;
			var academicYearStatus = academicYear.academic_year_status;

			$('#edacademicyearid').val(academicYearId);
			$('#edacademicyearname').val(academicYearName);
			$('#edacademicyearstartdate').val(academicYearStartDate);
			$('#edacademicyearenddate').val(academicYearEndDate);
			$('#edacademicyearstatus').val(academicYearStatus);
	
			 try{
                var editAcademicYearModel = document.getElementById('edit-academic-year-modal');
                var editAcademicYearModelClose = document.getElementById('edit-academic-year-modal-close-button');

                editAcademicYearModel.style.display = 'block';
                
                editAcademicYearModelClose.onclick = function(){
                    editAcademicYearModel.style.display = 'none';
                }
            }catch(e){
                    console.log('Demogorgon');
            } 
		}
	}
	});
}

function UpdateAcademicYear(){
	var updateacademicyeardata = $('#edit-academic-year-form').serialize();
	$.ajax({
		type: 'POST',
		data : updateacademicyeardata,
		url : baseUrl + '/api/update/academicyear',
		success : function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'success'){
                swal('Successful' , 'Academic year updated successfully' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/academicyear';
                }, 700);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
		}
	});
}

try{
	var addAcademicTermModalButton = document.getElementById('add-academic-term-modal-open-button');
	var addAcademicTermModal = document.getElementById('add-academic-term-modal');
	var addAcademicTermModalClose = document.getElementById('add-academic-term-modal-close-button');
	addAcademicTermModalButton.onclick = function(){
		addAcademicTermModal.style.display = 'block';
	}
	addAcademicTermModalClose.onclick = function(){
		addAcademicTermModal.style.display = 'none';
	}
}catch(e){
	console.log('Open the door 3 inches minimum');
}

function AddAcademicTerm(){
	var addacademicterm = $('#add-academic-term-form').serialize();

	$.ajax({
		type : 'POST',
		data : addacademicterm,
		url : baseUrl + '/api/add/academicterm',
		success : function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'success'){
                swal('Successful' , 'Academic term added successfully' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/academicyear';
                }, 700);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
		}
	});
}

function EditAcademicTerm(id){
	var editacademictermdata = {id:id};

	$.ajax({
		type:'POST',
		data : editacademictermdata,
		url : baseUrl + '/api/get/academicterm',
		success : function(msg){
			console.log(msg);

			if (msg == 'error') {
                swal('error' , 'Something went wrong try again and report error to us','error');
			}else{
				var academicTerm = JSON.parse(msg);
				var academicTermId = academicTerm.academic_term_id;
				var academicTermName = academicTerm.academic_term;
				var academicTermStartDate = academicTerm.academic_term_start_date;
				var academicTermEndDate = academicTerm.academic_term_end_date;
				var academicTermYear = academicTerm.academic_year_id;
		
				$('#edacademictermid').val(academicTermId);
				$('#edacademictermname').val(academicTermName);
				$('#edacademictermstartdate').val(academicTermStartDate);
				$('#edacademictermenddate').val(academicTermEndDate);
				$('#edacademictermyear').val(academicTermYear);
	


				try{
	                var editAcademicTermModel = document.getElementById('edit-academic-term-modal');
	                var editAcademicTermModelClose = document.getElementById('edit-academic-term-modal-close-button');

	                editAcademicTermModel.style.display = 'block';
	                
	                editAcademicTermModelClose.onclick = function(){
	                    editAcademicTermModel.style.display = 'none';
	                }
	            }catch(e){
	                    console.log('Demogorgon');
	            } 

	        }
		}

	});
}

function UpdateAcademicTerm(){
	var updateacademictermdata = $('#edit-academic-term-form').serialize();

	$.ajax({
		type: 'POST',
		data : updateacademictermdata,
		url : baseUrl + '/api/update/academicterm',
		success : function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'success'){
                swal('Successful' , 'Academic term updated successfully' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/academicyear';
                }, 700);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
		}
	});
}


try{
	var addCourseSelectionDateModalButton = document.getElementById('add-course-selection-date-modal-open-button');
	var addCourseSelectionDateModal = document.getElementById('add-course-selection-date-modal');
	var addCourseSelectionDateClose = document.getElementById('add-course-selection-date-modal-close-button');
	addCourseSelectionDateModalButton.onclick = function(){
		addCourseSelectionDateModal.style.display = 'block';
	}
	addCourseSelectionDateClose.onclick = function(){
		addCourseSelectionDateModal.style.display = 'none';
	}
}catch(e){
	console.log('Open the door 3 inches minimum');
}


function AddCourseSelectionDate(){
	var courseselectiondatedata = $('#add-course-selection-date-form').serialize();

	$.ajax({
		type: 'POST',
		data : courseselectiondatedata,
		url : baseUrl + '/api/add/courseselectiondate',
		success : function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'success'){
                swal('Successful' , 'Course selection date added successfully' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/academicyear';
                }, 700);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
		}

	});
}

function EditCourseSelectionDate(id){
	var data = {id:id};

	$.ajax({
		type : 'POST',
		data : data,
		url  : baseUrl + '/api/get/courseselectiondate',
		success : function(msg){
			console.log(msg);
			if (msg == 'error') {
                swal('error' , 'Something went wrong try again and report error to us','error');
			}else{
				var courseSelectionDate = JSON.parse(msg);
				var courseSelectionDateId  = courseSelectionDate.course_selection_date_id;
				var courseSelectionStartDate = courseSelectionDate.course_selection_start_date;
				var courseSelectionEndDate = courseSelectionDate.course_selection_end_date;
				var courseSelectionDateStatus = courseSelectionDate.course_selection_date_status;
				var courseSelectionDateTerm = courseSelectionDate.academic_term_id;

				$('#edcourseselectiondateid').val(courseSelectionDateId)
				$('#edcourseselectionstartdate').val(courseSelectionStartDate);
				$('#edcourseselectionenddate').val(courseSelectionEndDate);
				$('#edcourseselectiondatestatus').val(courseSelectionDateStatus);
				$('#edcourseselectionacademicterm').val(courseSelectionDateTerm);
			
				try{
	                var editCourseSelectionDateModel = document.getElementById('edit-course-selection-date-modal');
	                var editCourseSelectionDateModelClose = document.getElementById('edit-course-selection-date-modal-close-button');

	                editCourseSelectionDateModel.style.display = 'block';
	                
	                editCourseSelectionDateModelClose.onclick = function(){
	                    editCourseSelectionDateModel.style.display = 'none';
	                }
	            }catch(e){
	                    console.log('Demogorgon');
	            } 

	        }
		}
	});
}

function UpdateCourseSelectionDate(){
	var data = $('#edit-course-selection-date-form').serialize();

	$.ajax({
		type: 'POST',
		data : data,
		url : baseUrl + '/api/update/courseselectiondate',
		success: function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'success'){
                swal('Successful' , 'Course selection date updated successfully' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/courseselectionop';
                }, 700);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
		}
	});
}


function AcademicianStatusChange(val){
	switch(val) {
	  case 1:
			window.location = baseUrl + '/academicians';
	    break;
	  case 2:
			window.location = baseUrl + '/academicians/approved';
	    break;
	  case 3:
			window.location = baseUrl + '/academicians/unapproved';  	
	    break;
	  default:
    		window.location = baseUrl + '/academicians';
	} 
}

function StudentStatusChange(val){
	switch(val) {
	  case 1:
			window.location = baseUrl + '/students';
	    break;
	  case 2:
			window.location = baseUrl + '/students/approved';
	    break;
	  case 3:
			window.location = baseUrl + '/students/unapproved';	
	    break;
	  default:
    		window.location = baseUrl + '/students';
	} 
}




try{
	var addLessonModalButton = document.getElementById('add-lesson-modal-open-button');
	var addLessonModal = document.getElementById('add-lesson-modal');
	var addLessonClose = document.getElementById('add-lesson-modal-close-button');
	addLessonModalButton.onclick = function(){
		addLessonModal.style.display = 'block';
	}
	addLessonClose.onclick = function(){
		addLessonModal.style.display = 'none';
	}
}catch(e){
	console.log('Open the door 3 inches minimum');
}



function AddLesson(){
	var addlessondata = $('#add-lesson-form').serialize();
	$.ajax({
		type: 'POST',
		data : addlessondata,
		url : baseUrl + '/api/add/lesson',
		success : function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'facultyerror'){
                swal('Wrong Faculty' , 'Please select valid faculty' , 'error');
            }else if($.trim(msg) == 'departmenterror'){
                swal('Wrong Department' , 'Please select valid department' , 'error');
            }else if($.trim(msg) == 'academicianerror'){
                swal('Wrong Faculty' , 'Please select valid academician' , 'error');
            }else if($.trim(msg) == 'success'){
                swal('Successful' , 'Lesson added successfully' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/lessons';
                }, 700);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
		}

	});
}

function EditLesson(id){
	var data = {id:id};

	$.ajax({
		type:'POST',
		data : data,
		url : baseUrl + '/api/get/lesson',
		success : function(msg){
			console.log(msg);

			if (msg == 'error') {
                swal('error' , 'Something went wrong try again and report error to us','error');
			}else{
				var lesson = JSON.parse(msg);
				var lessonId = lesson.lesson_id;
				var lessonName = lesson.lesson_name;
				var lessonYear = lesson.lesson_year;
				var lessonTerm = lesson.academic_term_id;
				var lessonCredit = lesson.lesson_credit;
				var lessonTime = lesson.lesson_time;
				var lessonFaculty = lesson.faculty_id;
				var lessonDepartment = lesson.department_id;
				var lessonLecturer = lesson.academician_id;

				$('#edlessonid').val(lessonId);
				$('#edlessonname').val(lessonName);
				$('#edlessonyear').val(lessonYear);
				$('#edlessonterm').val(lessonTerm);
				$('#edlessoncredit').val(lessonCredit);
				$('#edlessontime').val(lessonTime);
				$('#edlessonfaculty').val(lessonFaculty);
				$('#edlessondepartment').val(lessonDepartment);
				$('#edlessonlecturer').val(lessonLecturer);


				try{
	                var editLessonModel = document.getElementById('edit-lesson-modal');
	                var editLessonModelClose = document.getElementById('edit-lesson-modal-close-button');

	                editLessonModel.style.display = 'block';
	                
	                editLessonModelClose.onclick = function(){
	                    editLessonModel.style.display = 'none';
	                }
	            }catch(e){
	                    console.log('Demogorgon');
	            } 

			}

			
		}
	});
}

function UpdateLesson(){
	var data = $('#edit-lesson-form').serialize();
	$.ajax({
		type : 'POST',
		data : data,
		url : baseUrl + '/api/update/lesson',
		success : function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'facultyerror'){
                swal('Wrong Faculty' , 'Please select valid faculty' , 'error');
            }else if($.trim(msg) == 'departmenterror'){
                swal('Wrong Department' , 'Please select valid department' , 'error');
            }else if($.trim(msg) == 'academicianerror'){
                swal('Wrong Faculty' , 'Please select valid academician' , 'error');
            }else if($.trim(msg) == 'success'){
                swal('Successful' , 'Lesson updated successfully' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/lessons';
                }, 700);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
		}
	});
}

function SelectLessons(){
	var data = $('#select-lesson-form').serialize();

	$.ajax({
		type:'POST',
		data : data,
		url : baseUrl + '/api/select/courses',
		success : function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'success'){
                swal('Successful' , 'Lessons Selected successfully' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/courseselection';
                }, 900);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
		}
	});
}

function SaveGrade(id,lessonId){
	var addgradedata = $('#add-grade-form-'+id).serialize();
	$.ajax({
		type : 'POST',
		data : addgradedata,
		url : baseUrl + '/api/add/grade',
		success : function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'gradeerror'){
                swal('Error' , 'Grade is must be greater than or equal to zero and must be lower than or equal to hundred' , 'error');
            }else if($.trim(msg) == 'successfulyupdated'){
                swal('Successful' , 'Grade is successfuly updated' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/addgrade/'+lessonId;
                }, 900);
            }else if($.trim(msg) == 'successfulyadded'){
                swal('Successful' , 'Grade is successfuly added' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/addgrade/'+lessonId;
                }, 900);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
		}
	});
}

function AddAttendance(id,lessonId){
	var addattendancedata = $('#add-attendance-form-'+id).serialize();
	$.ajax({
		type: 'POST',
		data : addattendancedata,
		url : baseUrl + '/api/add/attendance',
		success : function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'successfulyupdated'){
                swal('Successful' , 'Grade is successfuly updated' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/addattendance/'+lessonId;
                }, 900);
            }else if($.trim(msg) == 'successfulyadded'){
                swal('Successful' , 'Grade is successfuly added' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/addattendance/'+lessonId;
                }, 900);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
		}
	});
}

function ChangePassword(){
	var data = $('#change-password-form').serialize();
	$.ajax({
		type : 'POST',
		data : data,
		url : baseUrl + '/api/change/password',
		success : function(msg){
			console.log(msg);
			if ($.trim(msg) == 'empty' ) {
                swal('Error','Please fill required fields','error');
            }else if($.trim(msg) == 'passworderror'){
                swal('Error' , 'Your current password is wrong' , 'error');
            }else if($.trim(msg) == 'success'){
                swal('Successful' , 'Password Successfuly changed' , 'success');
                    setTimeout(function(){
                        window.location = baseUrl+'/settings'
                }, 900);
            }else{
                swal('Error' , 'Something went wrong please try again and report the error' , 'error');
            }
		}
	});
}