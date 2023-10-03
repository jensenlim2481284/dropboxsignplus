


/*
    #1 - Flexible file upload design  x 
    #2 - File type checking 
    #3 - File optimization ? https://embed.plnkr.co/plunk/v5JU2v  
    #4 - Seperate file checking and optimization function  x 
    #5 - File display  x 
    #6 - Multiple file display  x 

*/



// File Upload

//Function to check file format 
function fileTypeChecking(file, type)
{
    if(type =="image")
        return /\.(?=jpg|png|jpeg|jfif)/gi.test(file.name)
    if(type == "csv")
        return /\.(?=csv|xlsx)/gi.test(file.name)
}



//Function to initalize uploadBox
function initialUploadBox(fileInputID, fileDragID, messageID, labelID ,responseID, displayID, type='image')
{

    //Initialize 
    function Init() {            
        var fileSelect = document.getElementById(fileInputID);
        fileSelect.addEventListener("change", fileSelectHandler, false);          
    }


    //File drag hover
    function fileDragHover(e) {            
        var fileDrag = document.getElementById(fileDragID);
        e.stopPropagation();
        e.preventDefault();
        fileDrag.className =
            e.type === "dragover" ? "hover" : "modal-body file-upload";
    }
    

    //File select
    function fileSelectHandler(e) {
        
        var files = e.target.files || e.dataTransfer.files;            
        fileDragHover(e);

        var filesLength = files.length;
        if(filesLength == 1){
            parseFile(files[0]);
            output("<strong id='fileMsg'>" + encodeURI(files[0].name) + "</strong>");
        }
        else {
            // Process all File objects            
            for (var i = 0, f; (f = files[i]); i++) {
                parseFile(f);
            }
            output("<strong id='fileMsg'>" + filesLength + " Files</strong>");
        }

        
    }

    
    // Output
    function output(msg) {
        // Response
        var m = document.getElementById(messageID);
        m.innerHTML = msg;
    }

    
    //Parse file 
    function parseFile(file) {  
        var isGood = fileTypeChecking(file, type);                        
        if (isGood) {
            document.getElementById(labelID).classList.add("hidden");
            document.getElementById(responseID).classList.remove("hidden");
            
            // Thumbnail Preview
            document.getElementById(displayID).classList.remove("hidden");
            document.getElementById(displayID).src = URL.createObjectURL(
                file
            );

        } else {
            document.getElementById(displayID).classList.add("hidden");                
            document.getElementById(labelID).classList.remove("hidden");
            document.getElementById(responseID).classList.add("hidden");                
            swal('','Invalid File Format. 文件格式不对','warning'); 
        }
    }

    
    // Check for the various File API support.
    if (window.File && window.FileList && window.FileReader) {
        Init();
    } else {            
        document.getElementById(fileDragID).style.display = "none";                       
    }

}
