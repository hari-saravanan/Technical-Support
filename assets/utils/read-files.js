
    var jsonObject = null;
    document.getElementById("submit")
        .addEventListener("click", function () {
            if(jsonObject != null){
                insertStudents(jsonObject);
            }
        })

    var selectedFile = null;
    document
        .getElementById("fileUpload")
        .addEventListener("change", function(event) {
            selectedFile = event.target.files[0];
            var fileReader = new FileReader();
            fileReader.onload = function(event) {
                var data = event.target.result;

                var workbook = XLSX.read(data, {
                    type: "binary"
                });
                workbook.SheetNames.forEach(sheet => {
                    let rowObject = XLSX.utils.sheet_to_row_object_array(
                        workbook.Sheets[sheet]
                    );
                    let jsonObject = JSON.stringify(rowObject);
                    document.getElementById("sampleData").style.display = "none";
                    document.getElementById("sampleTable").style.display = "none";
                    document.getElementById("jsonData").innerHTML = jsonToTable(jsonObject);
                });
            };
            fileReader.readAsBinaryString(selectedFile);
        });

    getRoles();
    
    function jsonToTable(jsonObject) {
        var convertedArray = JSON.parse(jsonObject);
        this.jsonObject = convertedArray;
        var keys = Object.keys(convertedArray[0]);
        var tableHeadings = "<thead><tr>";
        var tableData = "";
        var keyLength = true;
        var columnName = true;

        if(keys.length != 3){
            keyLength = false;
        }

        console.log(keys);
        keys.forEach(function (item) {
            if(item == "First Name" || item == "Last Name" || item == "Reg No"){
                tableHeadings += "<td>" + item + "</td>";
            } else {
                columnName = false;
            }
        })
        tableHeadings += "</tr></thead>";

        console.log(jsonObject);


        console.log(convertedArray);
        convertedArray.forEach(function (item) {
            tableData += "<tbody><tr>";
            keys.forEach(function (value) {
                tableData += "<td>" + item[value] +"</td>";
            })
            tableData += "</tr></tbody>"
        })
        if(keyLength && columnName){
            return "<table id='users' class='table table-striped'>" + tableHeadings + tableData + "</table>";
        } else if(!keyLength){
            return "No of rows does not match";
        } else {
            return "Column Names does not match";
        }

    }

    function insertStudents(jsonObject) {
        var url = "./assets/ajax-services/add-students.php";
        var data = null;
        var selectedRole = $('#roles').val();
        var resultantArray = [];
        if(selectedRole != 0){
            jsonObject.forEach(function (item) {
                data = {
                    'firstName' : item['First Name'],
                    'lastName' : item['Last Name'],
                    'username' : item['Reg No'],
                    'roleId' : selectedRole
                }

                $.post(url, data, function (result) {
                    item['Status'] = JSON.parse(result).message;
                    resultantArray.push(item);
                })
            })
            jsonToTableFinal(jsonObject);
            console.log(jsonObject);
        } else {
            alert("Kindly Select Role");
        }


    }

    function getRoles() {
        var url = './assets/ajax-services/get-roles.php';
        var html = '<option value = "0">Select</option>';
        $.get(url, function (result) {
            console.log(result);
            var json = JSON.parse(result);
            json.forEach(function (item) {
                html += '<option value="'+ item['id'] +'">' + item['name'] + '</option>';
            })
            $('#roles').append(html);
        })
    }

    function jsonToTableFinal(jsonObject) {
        var keys = Object.keys(jsonObject[0]);
        var tableHeadings = "<thead><tr>";
        var tableData = "";

        keys.forEach(function (item) {
             tableHeadings += "<td>" + item + "</td>";
        })

        jsonObject.forEach(function (item) {
            tableData += "<tbody><tr>";
            keys.forEach(function (value) {
                tableData += "<td>" + item[value] +"</td>";
            })
            tableData += "</tr></tbody>"
        })

        $('#users').empty();
        $('#users').append(tableHeadings + tableData);
    }