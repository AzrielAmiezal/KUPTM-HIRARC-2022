function ddl()
{
    var d1 = document.getElementById("probability");
    var d2 = document.getElementById("impact");
      
    var display1 = d1.options[d1.selectedIndex].value;
    var display2 = d2.options[d2.selectedIndex].value; 

    var result = parseFloat(display1) * parseFloat(display2);
    
    if (result >= 15) {
        document.getElementById("riskLevel").value = "VERY HIGH";
    }
    else if (result < 15 && result >= 8) {
        document.getElementById("riskLevel").value = "HIGH";
    }
    else if (result < 8 && result >= 4) {
        document.getElementById("riskLevel").value = "MEDIUM";
    }
    else {
        document.getElementById("riskLevel").value = "LOW";
    }
}

// function ddl2()
// {
//     var d1 = document.getElementById("probability[0]");
//     var d2 = document.getElementById("impact[0]");
    
    
//     var display1 = d1.options[d1.selectedIndex].value;
//     var display2 = d2.options[d2.selectedIndex].value; 

//     var result = parseFloat(display1) * parseFloat(display2);
    
//     if (result >= 15) {
//         document.getElementById("riskLevel[0]").value = "VERY HIGH";
//     }
//     else if (result < 15 && result >= 8) {
//         document.getElementById("riskLevel[0]").value = "HIGH";
//     }
//     else if (result < 8 && result >= 4) {
//         document.getElementById("riskLevel[0]").value = "MEDIUM";
//     }
//     else {
//         document.getElementById("riskLevel[0]").value = "LOW";
//     }
// }

// function ddl2()
// {
//     var d_1 = document.getElementById("probability");
//     var d_2 = document.getElementById("impact");
//     var d1 = document.getElementById("probability[0]");
//     var d2 = document.getElementById("impact[0]");
//     var d3 = document.getElementById("probability[1]");
//     var d4 = document.getElementById("impact[1]");
//     var d5 = document.getElementById("probability[2]");
//     var d6 = document.getElementById("impact[2]");
//     var d7 = document.getElementById("probability[3]");
//     var d8 = document.getElementById("impact[3]");

//     var display_1 = d_1.options[d_1.selectedIndex].value;
//     var display_2 = d_2.options[d_2.selectedIndex].value;
//     var display1 = d1.options[d1.selectedIndex].value;
//     var display2 = d2.options[d2.selectedIndex].value; 
//     var display3 = d3.options[d3.selectedIndex].value;
//     var display4 = d4.options[d4.selectedIndex].value; 
//     var display5 = d5.options[d5.selectedIndex].value;
//     var display6 = d6.options[d6.selectedIndex].value; 
//     var display7 = d7.options[d7.selectedIndex].value;
//     var display8 = d8.options[d8.selectedIndex].value; 

//     var result = parseFloat(display_1) * parseFloat(display_2);
//     var result1 = parseFloat(display1) * parseFloat(display2);
//     var result2 = parseFloat(display3) * parseFloat(display4);
//     var result3 = parseFloat(display5) * parseFloat(display6);
//     var result4 = parseFloat(display7) * parseFloat(display8);
//     // document.getElementById("ri").value = result;

//     if (result >= 15) {
//         document.getElementById("riskLevel").value = "VERY HIGH";
//     }
//     else if (result < 15 && result >= 8) {
//         document.getElementById("riskLevel").value = "HIGH";
//     }
//     else if (result < 8 && result >= 4) {
//         document.getElementById("riskLevel").value = "MEDIUM";
//     }
//     else {
//         document.getElementById("riskLevel").value = "LOW";
//     }

//     if (result1 >= 15) {
//         document.getElementById("riskLevel[0]").value = "VERY HIGH";
//     }
//     else if (result1 < 15 && result1 >= 8) {
//         document.getElementById("riskLevel[0]").value = "HIGH";
//     }
//     else if (result1 < 8 && result1 >= 4) {
//         document.getElementById("riskLevel[0]").value = "MEDIUM";
//     }
//     else {
//         document.getElementById("riskLevel[0]").value = "LOW";
//     }

//     if (result2 >= 15) {
//         document.getElementById("riskLevel[1]").value = "VERY HIGH";
//     }
//     else if (result2 < 15 && result2 >= 8) {
//         document.getElementById("riskLevel[1]").value = "HIGH";
//     }
//     else if (result2 < 8 && result2 >= 4) {
//         document.getElementById("riskLevel[1]").value = "MEDIUM";
//     }
//     else {
//         document.getElementById("riskLevel[1]").value = "LOW";
//     }

//     if (result3 >= 15) {
//         document.getElementById("riskLevel[2]").value = "VERY HIGH";
//     }
//     else if (result3 < 15 && result3 >= 8) {
//         document.getElementById("riskLevel[2]").value = "HIGH";
//     }
//     else if (result3 < 8 && result3 >= 4) {
//         document.getElementById("riskLevel[2]").value = "MEDIUM";
//     }
//     else {
//         document.getElementById("riskLevel[2]").value = "LOW";
//     }

//     if (result4 >= 15) {
//         document.getElementById("riskLevel[3]").value = "VERY HIGH";
//     }
//     else if (result4 < 15 && result4 >= 8) {
//         document.getElementById("riskLevel[3]").value = "HIGH";
//     }
//     else if (result4 < 8 && result4 >= 4) {
//         document.getElementById("riskLevel[3]").value = "MEDIUM";
//     }
//     else {
//         document.getElementById("riskLevel[3]").value = "LOW";
//     }
// }


function previewImage() {
	const picture = document.querySelector('.picture');
	const imgPreview = document.querySelector('.img-preview');

	const oFReader = new FileReader();
	oFReader.readAsDataURL(picture.files[0]);

	oFReader.onload = function (oFREvent) {
	    imgPreview.src = oFREvent.target.result;
	};

}
