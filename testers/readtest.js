  //the tab-delimited files that we will be reading from to create the arrays
var ansFile = File(~/var/www/html/nudge/testers/answersTest.txt);
var stoFile = File(~/var/www/html/nudge/testers/storylineTest.txt);

  //The input and output streams
ansFile.open("r");
stoFile.open("r");





  //Set the global variablewhat to be.
var cur = "start";
var pot = null;


  //the arrays that will store the text from the answers and storyline files
var ansArr = []; //answers
var titArr = []; //titles
var resArr = []; //potential results
var probArr = []; //probabilities
var outArr = []; //Outcomes


var i = 0;
var numAns = 0;
var userInput = null;
var posi = 0; //position of the title

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



while(pot != null)
{
    //this log only works for the initial case(i=0)
    //use the findTitlePos function for the other cases.
  if (i===0)
  {
    console.log(outArr[i]);
  }
  else
  {
    posi = findTitlePos(resArr[inputIndex], titArr);
    console.log(outArr[posi]);
  }
  
    //change the data in the answer column to be arrays
  numAns = (ansArr[i]).length //i may need to based on the string value of title. consider changing format of worksheets
  
  for(var j=0; j<numAns; j++)
  {
    if (ansArr[j] != "end")
    {
      var letter = String.fromCharCode(65+j); //gets letter to update ASCII values
      console.log(letter + ": " + ansArr[j]);
        //this line needs to go outside of the for loop???
        //and everything else in this block???
      pot ="What letter answer would you like to choose?";
      
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
    }
    else
    {
	  //break out of the loop if we have reached an absolute end to the storyli
	pot = null; //potential resus null sincat the end of the story
	console.log(
	console.log("Thanks for playing! we hope you enjoyed it");
	break;
    }
  }
  i = i+1;
}
