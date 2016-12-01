

/*Functions to show labels in textboxes before text value input*/
function toggleInputTypeValueOnFocus(input, newInputType, newInputValue) {
	input.type = newInputType;
	input.value = newInputValue;
}

function toggleInputTypeValueOnBlur(input, newInputType, newInputValue) {
	if (input.value == '') {
		input.type = newInputType;
		input.value = newInputValue;
	}
}

//check to see if text input has '@' and '.' before form is submitted
function validateEmail(formName, inputName) {
	console.log("validateEmail " + formName + " " + inputName);

	var input = document.forms[formName] [inputName];
	var text = input.value;

	var atpos = text.indexOf("@");
	var dotpos = text.lastIndexOf(".");
	
	if(atpos < 1 || dotpos < atpos + 2 || dotpos + 2 > text.length) {
		alert("Please enter a valid email address");
		return false;
	}	
	return true;
}

function validateInputContentByName(formName, inputName, seedValue) {
	console.log("validateInputContentByName " + formName + " " + inputName);

	var input = document.forms[formName][inputName];
	return validateInputContent(input, seedValue);
}

function validateInputContent(input, seedValue) {

	var text = input.value;

	if(text == seedValue || text == "") {
		alert("Please enter " + seedValue);
		return false;
	}
	return true;
}

