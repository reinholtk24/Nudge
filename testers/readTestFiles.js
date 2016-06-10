/*$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "answersTest.txt",
        dataType: "text",
        success: function(data) {processData(data);}
     });
});

function processData(allText) {
    var allTextLines = allText.split(/\r\n|\n/);
    var headers = allTextLines[0].split(',');
    var lines = [];

    for (var i=1; i<allTextLines.length; i++) {
        var data = allTextLines[i].split('/t');
        if (data.length == headers.length) {

            var tarr = [];
            for (var j=0; j<headers.length; j++) {
                tarr.push(headers[j]+":"+data[j]);
            }
            lines.push(tarr);
        }
    }
    // alert(lines);
}
*/


  //finds the position at which a title is found. Static method.
var findTitlePos = function(title, array)
{
	var elem = null;
	var len = array.length;
	
	for(var i = 0; i < len; i++)
	{
	  if (title array[i])
	    {return i;}
	  else
	    {continue;}
	}

	if (elem === null)
	{
	  console.log("Title was not found in the array. We will return null.");
	}
	return null;
}

	//Set the global variables to the initial cases
var cur = "start";
var pot = null;

  //the tab-delimited files that we will be reading from to create the arrays
var ansFile = File(~/var/www/html/nudge/testers/answersTest.txt);
var stoFile = File(~/var/www/html/nudge/testers/storylineTest.txt);

  //the arrays that will store the text from the answers and storyline files
var ansArr = []; //answers
var titArr = []; //titles
var resArr = []; //potential results
var probArr = []; //probabilities
var outArr = []; //Outcomes

  //The input and output streams
ansFile.open("r");
stoFile.open("r");

var i = 0;
var numAns = 0;
var userInput = null;
var posi = 0; //position of the title

while (cur != null)
{
    //this log only works for the initial case(i=0)
    //use the findTitlePos function for the other cases.
  if (i===0) //could also use cur === "start"
  {
    console.log(outArr[i]);
  }
  else
  {
      //print the outcome at the current position
    posi = findTitlePos(resArr[inputIndex], titArr);
    console.log(outArr[posi]);
  }
      //change the data in the answer column to be arrays
  numAns = (ansArr[i]).length //i may need to based on the string value of title. consider changing format of worksheets
  
  for(var j=0; j<numAns; j++)
  {
    if (ansArr[j] != "You are finished")
    {
      var letter = String.fromCharCode(65+j); //gets letter to update ASCII values
      console.log(letter + ": " + ansArr[j]);
      pot = prompt("What letter answer would you like to choose?");
    }
    else
    {
	  //break out of the loop if we have reached an absolute end to the storyli
	console.log("Thanks for playing! we hope you enjoyed it");
        pot = null; //potential result null since we are done with the stroyline
	break;
    }
  }

      //change the data in the answer column to be array
      if (pot.toUpperCase() === "A")
      {
       	inputIndex = 0;
      }
      else if (pot.toUpperCase() === "B")
      {
       	inputIndex = 1;
      }
      else if (pot.toUpperCase() === "C")
      {
       	inputIndex = 2;
      }
      else if (pot.toUpperCase() === "D")
      {
       	inputIndex = 3;
      }
  
    //we will use the inputIndex to get the Index of the next title we want to go to in the title array
  
  i = i+1;
}
