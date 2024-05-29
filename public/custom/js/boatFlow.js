var id = document.getElementById("drawflow");
var  Nodeid='';
var dataArray = [];
const editor = new Drawflow(id);
editor.reroute = true;
editor.start();
// Events!
editor.on('nodeCreated', function (id) {
  console.log("Node created " + id);
   Nodeid = id;
})

editor.on('nodeRemoved', function (id) {
  console.log("Node removed " + id);
})

editor.on('nodeSelected', function (id) {
   console.log("Node selected " + id);
    Nodeid = id;
;
})

editor.on('moduleCreated', function (name) {
  console.log("Module Created " + name);
})

editor.on('moduleChanged', function (name) {
  console.log("Module Changed " + name);
})

editor.on('connectionCreated', function (connection) {
  console.log('Connection created');
  console.log(connection);
})

editor.on('connectionRemoved', function (connection) {
  console.log('Connection removed');
  console.log(connection);
})

editor.on('mouseMove', function (position) {
  // console.log('Position mouse x:' + position.x + ' y:' + position.y);
})

editor.on('nodeMoved', function (id) {
  console.log("Node moved " + id);
})

editor.on('zoom', function (zoom) {
  console.log('Zoom level ' + zoom);
})

editor.on('translate', function (position) {
  console.log('Translate x:' + position.x + ' y:' + position.y);
})

editor.on('addReroute', function (id) {
  console.log("Reroute added " + id);
})

editor.on('removeReroute', function (id) {
  console.log("Reroute removed " + id);
})

/* DRAG EVENT */

/* Mouse and Touch Actions */

var elements = document.getElementsByClassName('drag-drawflow');
for (var i = 0; i < elements.length; i++) {
  elements[i].addEventListener('touchend', drop, false);
  elements[i].addEventListener('touchmove', positionMobile, false);
  elements[i].addEventListener('touchstart', drag, false);
}

var mobile_item_selec = '';
var mobile_last_move = null;
function positionMobile(ev) {
  mobile_last_move = event;
}

function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  if (ev.type === "touchstart") {
    mobile_item_selec = ev.target.closest(".drag-drawflow").getAttribute('data-node');
  } else {
    ev.dataTransfer.setData("node", ev.target.getAttribute('data-node'));
  }
}

function drop(ev) {
  if (ev.type === "touchend") {
    var parentdrawflow = document.elementFromPoint(mobile_last_move.touches[0].clientX, mobile_last_move.touches[0].clientY).closest("#drawflow");
    if (parentdrawflow != null) {
      addNodeToDrawFlow(mobile_item_selec, mobile_last_move.touches[0].clientX, mobile_last_move.touches[0].clientY);
    }
    mobile_item_selec = '';
  } else {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("node");
    addNodeToDrawFlow(data, ev.clientX, ev.clientY);
  }

}

function renderNodeContent() {
  // Find the matching data object based on nodeId
  var matchedData = dataArray.find(function(item) {
    return item.nodeId === Nodeid;
  });

   console.log('matchedData',matchedData);
  // Create HTML content
  var htmlContent;

  // If no matching data is found, return default content
  if (!matchedData) {
    htmlContent = `
      <div>
        <div class="title-box"><i class="fab fa-telegram-plane"></i>Send Message</div>
        <div class="box">
          <span onclick="openNav()">Open</span>
        </div>
      </div>
    `; 
  } else {
    // Extract message from the matched data object
     console.log('matchedData.message',matchedData.message);
     var message = matchedData.message;

    // Create HTML content based on the matched data
    htmlContent = `
      <div>
        <div class="title-box"><i class="fab fa-telegram-plane"></i>Send Message</div>
        <div class="box">
          <p>Message: ${message}</p>
          <span onclick="openNav()">Open</span>
        </div>
      </div>
    `;
  }

  return htmlContent;
}


function addNodeToDrawFlow(name, pos_x, pos_y) {
  if (editor.editor_mode === 'fixed') {
    return false;
  }
  pos_x = pos_x * (editor.precanvas.clientWidth / (editor.precanvas.clientWidth * editor.zoom)) - (editor.precanvas.getBoundingClientRect().x * (editor.precanvas.clientWidth / (editor.precanvas.clientWidth * editor.zoom)));
  pos_y = pos_y * (editor.precanvas.clientHeight / (editor.precanvas.clientHeight * editor.zoom)) - (editor.precanvas.getBoundingClientRect().y * (editor.precanvas.clientHeight / (editor.precanvas.clientHeight * editor.zoom)));
  

switch (name) {
  
    case 'template':
        // Data object for the template node
        var templateData = { "template": 'Write your template' };
        // Render HTML content for the template node
         var templateContent = renderNodeContent('template', templateData);

          var template = `
          <div>
          <div class="title-box"><i class="fab fa-telegram-plane"></i>Send Message</div>
          <div class="box">
            
            <span onclick="openNav()">open</span>
          </div>
        </div>
        `;
         console.log('templateContent',templateContent);
         var templateContent = renderNodeContent();

  
        // Add the template node to the editor with the rendered HTML content
        editor.addNode('template', 1, 1, pos_x, pos_y, 'template', templateData, templateContent);
        break;

        case 'start':
           console.log('here',initialNodeData);
          // Data object for the template node
          var templateData = { "start": 'Write your template' };

          // Render HTML content for the template node
           var templateContent = renderNodeContent('template', templateData);
              var template = `
                <div>
                  <h1>Start</h1>
                   <p>${initialNodeData.trigger}</p>
                </div>
            `;
          editor.addNode('start', 1, 1, pos_x, pos_y, 'start', templateData, template);
          break;
    default:
}


}

/* Set the width of the side navigation to 250px */
function openNav() {
  var inputElement = document.getElementById("my-textfield");
// Set the value of the input field to newValue
  inputElement.value = Nodeid;
  document.getElementById("mySidenav").style.width = "300px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

var transform = '';
function showpopup(e) {
  e.target.closest(".drawflow-node").style.zIndex = "9999";
  e.target.children[0].style.display = "block";
  //document.getElementById("modalfix").style.display = "block";

  //e.target.children[0].style.transform = 'translate('+translate.x+'px, '+translate.y+'px)';
  transform = editor.precanvas.style.transform;
  editor.precanvas.style.transform = '';
  editor.precanvas.style.left = editor.canvas_x + 'px';
  editor.precanvas.style.top = editor.canvas_y + 'px';
  console.log(transform);

  //e.target.children[0].style.top  =  -editor.canvas_y - editor.container.offsetTop +'px';
  //e.target.children[0].style.left  =  -editor.canvas_x  - editor.container.offsetLeft +'px';
  editor.editor_mode = "fixed";

}

function closemodal(e) {
  e.target.closest(".drawflow-node").style.zIndex = "2";
  e.target.parentElement.parentElement.style.display = "none";
  //document.getElementById("modalfix").style.display = "none";
  editor.precanvas.style.transform = transform;
  editor.precanvas.style.left = '0px';
  editor.precanvas.style.top = '0px';
  editor.editor_mode = "edit";
}

function changeModule(event) {
  var all = document.querySelectorAll(".menu ul li");
  for (var i = 0; i < all.length; i++) {
    all[i].classList.remove('selected');
  }
  event.target.classList.add('selected');
}

function changeMode(option) {

  //console.log(lock.id);
  if (option == 'lock') {
    lock.style.display = 'none';
    unlock.style.display = 'block';
  } else {
    lock.style.display = 'block';
    unlock.style.display = 'none';
  }

}

function addDefaultNode() {
  // Set the position for the default node
  var defaultPosX = 100; // Adjust the X position as needed
  var defaultPosY = 100; // Adjust the Y position as needed

  // Add the default node to the editor
  addNodeToDrawFlow('start', defaultPosX, defaultPosY);
}


// function handleFormSubmission(event) {
//   event.preventDefault(); // Prevent the default form submissio
//     // Log the event object for debugging purposes
//     console.log('Event:', event);

//     // Get the form data
//     var formData = new FormData(event.target);

//     // Convert FormData to a plain object
//     var formObject = {};
//     formData.forEach((value, key) => {
//         formObject[key] = value;
//     });

//     // Log the form data for debugging purposes
//     console.log('Form Data:', formObject);
//   // // Make an AJAX call using Fetch API
//   // fetch('/your-endpoint-url', { // Specify your endpoint URL here
//   //     method: 'POST',
//   //     headers: {
//   //         'Content-Type': 'application/json'
//   //     },
//   //     body: JSON.stringify(formObject)
//   // })
//   // .then(response => response.json())
//   // .then(data => {
//   //     console.log("Form submitted successfully!");
//   //     console.log("Response:", data);

//   //     // Update your Drawflow editor based on the response if needed
//   // })
//   // .catch(error => {
//   //     console.error("Error:", error);
//   // });
// }



function handleFormSubmission(event) {
  
  event.preventDefault(); // Prevent the default form submission

  // Get the form data
  var formData = new FormData(event.target);
  console.log(formData)
  // Convert FormData to a plain object
  var formObject = {};
  formData.forEach((value, key) => {
      formObject[key] = value;
  });

  // Log the form data for debugging purposes
  console.log('Form Data:', formObject);

  // Make an AJAX call using Fetch API
  // fetch('/your-endpoint-url', { // Specify your endpoint URL here
  //     method: 'POST',
  //     headers: {
  //         'Content-Type': 'application/json'
  //     },
  //     body: JSON.stringify(formObject)
  // })
  // .then(response => response.json())
  // .then(data => {
  //     console.log("Form submitted successfully!");
  //     console.log("Response:", data);

  //     // Update your Drawflow editor based on the response if needed
  // })
  // .catch(error => {
  //     console.error("Error:", error);
  // });
}
// save node data 
   document.addEventListener('DOMContentLoaded', function() {
    addDefaultNode();
    console.log("Event listener attached to nodeForm");
    document.getElementById("nodeForm").addEventListener("submit", handleFormSubmission);
    document.getElementById('save-button').addEventListener('click', function(event) {
      // event.preventDefault(); // Prevent default form submission behavior

      // Get the values from the input fields
      var nodeId = document.getElementById('my-textfield').value.trim();
      var message = document.getElementById('my-textarea').value.trim();

      // Check if required data is provided
      if (nodeId === '' || message === '') {
          alert('Please enter both Node Id and Message.');
          return; // Exit early if data is incomplete
      }

      // Create an object with the retrieved data
      var dataObject = {
          nodeId: nodeId,
          message: message
      };

      // Push the data object into the array
      dataArray.push(dataObject);
  
      // Log the updated array for debugging (optional)
      console.log("Updated Data Array:", dataArray);
      renderNodeContent();

      // Clear the input fields after processing
      document.getElementById('my-textfield').value = '';
      document.getElementById('my-textarea').value = '';

      // Optionally, perform other actions with the stored data
      // For example, you might want to send this data to a server via fetch()
    });



    
});

