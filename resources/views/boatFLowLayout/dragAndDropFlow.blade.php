@extends('boatFlowLayout.layout')
@section('content')
    <div class="col-8">
        <a href="{{ route('flows.index',['id'=>$back_id]) }}" class="btn btn-sm btn-primary">Back</a>
    </div>
    <div id="mySidenav" class="sidenav">
         {{-- <form id="nodeForm" action="/" method="post">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <h1 class="text-xl font-bold mb-4">Send Text Message</h1>
            <div id="section2" class="p-6 rounded shadow bg-white">
                <div class="mb-4">
                    <label for="my-textfield" class="block text-gray-700 font-semibold mb-2">Node Id</label>
                    <input id="my-textfield" type="id" placeholder="Enter text..." class="form-input w-full border border-gray-300 rounded-md focus:outline-none focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    <p class="mt-1 text-sm text-gray-500">Add notes about populating the field</p>
                </div>
                <div class="mb-4">
                    <label for="my-textarea" class="block text-gray-700 font-semibold mb-2">Message</label>
                    <textarea id="my-textarea" rows="4"  name="text" placeholder="Enter text..." class="form-textarea w-full border border-gray-300 rounded-md focus:outline-none focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"></textarea>
                    <p class="mt-1 text-sm text-gray-500">Add notes about populating the field</p>
                </div>
                <button  type="submit" id="save-button" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    Save
                </button>
                <button type="reset" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2 focus:outline-none focus:ring focus:ring-red-500 focus:ring-opacity-50">
                    Clear
                </button>

            </div>
        </form> --}}

        {{-- <form id="nodeForm" method="post" onsubmit="handleFormSubmission(event)">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <h1 class="text-xl font-bold mb-4">Send Text Message</h1>
            <div id="section2" class="p-6 rounded shadow bg-white">
                <div class="mb-4">
                    <label for="my-textfield" class="block text-gray-700 font-semibold mb-2">Node Id</label>
                    <input id="my-textfield" type="text" name="nodeId" placeholder="Enter text..." class="form-input w-full border border-gray-300 rounded-md focus:outline-none focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" value="">
                    <p class="mt-1 text-sm text-gray-500">Add notes about populating the field</p>
                </div>
                <div class="mb-4">
                    <label for="my-textarea" class="block text-gray-700 font-semibold mb-2">Message</label>
                    <textarea id="my-textarea" rows="4" name="text" placeholder="Enter text..." value="" class="form-textarea w-full border border-gray-300 rounded-md focus:outline-none focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"></textarea>
                    <p class="mt-1 text-sm text-gray-500">Add notes about populating the field</p>
                </div>
                <button type="submit" id="save-button" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    Save
                </button>
                <button type="reset" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2 focus:outline-none focus:ring focus:ring-red-500 focus:ring-opacity-50">
                    Clear
                </button>
            </div>
        </form>
         --}}

         <form id="nodeForm" method="post" onsubmit="handleFormSubmission(event)">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <h1 class="text-xl font-bold mb-4">Send Text Message</h1>
            <div id="section2" class="p-6 rounded shadow bg-white">
                <div class="mb-4">
                    <label for="my-textfield" class="block text-gray-700 font-semibold mb-2">Node Id</label>
                    <input id="my-textfield" type="text" name="nodeId" placeholder="Enter text..." class="form-input w-full border border-gray-300 rounded-md focus:outline-none focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    <p class="mt-1 text-sm text-gray-500">Add notes about populating the field</p>
                </div>
                <div class="mb-4">
                    <label for="my-textarea" class="block text-gray-700 font-semibold mb-2">Message</label>
                    <textarea id="my-textarea" rows="4" name="text" placeholder="Enter text..." class="form-textarea w-full border border-gray-300 rounded-md focus:outline-none focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"></textarea>
                    <p class="mt-1 text-sm text-gray-500">Add notes about populating the field</p>
                </div>
                <button type="submit" id="save-button" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    Save
                </button>
                <button type="reset" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2 focus:outline-none focus:ring focus:ring-red-500 focus:ring-opacity-50">
                    Clear
                </button>
            </div>
        </form>
    </div>
    <div class="wrapper">
        <div class="col-right">
            <div id="drawflow" ondrop="drop(event)" ondragover="allowDrop(event)">
                <div class="btn-export text-gray-700 cursor-pointer"
                    onclick="Swal.fire({ title: 'Export',
                      html: '<pre><code>'+JSON.stringify(editor.export(), null,4)+'</code></pre>'
                      })">
                    Export</div>
                <div class="btn-clear text-gray-700 cursor-pointer" onclick="editor.clearModuleSelected()">Clear</div>
                <div class="btn-lock">
                    <i id="lock" class="fas fa-lock text-gray-700 cursor-pointer" onclick="editor.editor_mode='fixed'; changeMode('lock');"></i>
                    <i id="unlock" class="fas fa-lock-open text-gray-700 cursor-pointer" onclick="editor.editor_mode='edit'; changeMode('unlock');"
                        style="display:none;"></i>
                </div>
                <div class="bar-zoom">
                    <i class="fas fa-search-minus text-gray-700 cursor-pointer" onclick="editor.zoom_out()"></i>
                    <i class="fas fa-search text-gray-700 cursor-pointer" onclick="editor.zoom_reset()"></i>
                    <i class="fas fa-search-plus text-gray-700 cursor-pointer" onclick="editor.zoom_in()"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="drag-drawflow bg-gray-100 border border-gray-200 rounded-md py-2 px-4 cursor-move text-gray-700" draggable="true" ondragstart="drag(event)" data-node="template">
                <i class="fas fa-code"></i><span class="ml-2">Template</span>
            </div>
        </div>
    </div>

    <footer>
        <script src="{{ asset('custom/js/boatFlow.js') }}"></script>
    </footer>
     <script>
       var initialNodeData = @json($items);
     </script>
    <script>
        function changeModule(event) {
           
            var all = document.querySelectorAll(".menu ul li");
            for (var i = 0; i < all.length; i++) {
                all[i].classList.remove('selected');
            }
            event.target.classList.add('selected');
        }
        
        function changeMode(option) {
            var lock = document.getElementById('lock');
            var unlock = document.getElementById('unlock');
            if (option === 'lock') {
                lock.style.display = 'none';
                unlock.style.display = 'block';
            } else {
                lock.style.display = 'block';
                unlock.style.display = 'none';
            }
        }

</script>



        
@endsection
