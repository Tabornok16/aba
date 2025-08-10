@props(['user'])

<div id="voterVerificationModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Verify Voter Information
                        </h3>
                        <div class="mt-4">
                            <form id="voterVerificationForm" class="space-y-4">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                                    <input type="text" name="middle_name" id="middle_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </form>
                            <div id="verificationResult" class="mt-4 hidden">
                                <div class="rounded-md p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg id="successIcon" class="h-5 w-5 text-green-400 hidden" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            <svg id="errorIcon" class="h-5 w-5 text-red-400 hidden" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p id="verificationMessage" class="text-sm font-medium"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="verifyVoter()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Verify
                </button>
                <button type="button" onclick="hideVoterVerificationModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentUserId = null;

function showVoterVerificationModal(userId) {
    currentUserId = userId;
    const modal = document.getElementById('voterVerificationModal');
    modal.classList.remove('hidden');
}

function hideVoterVerificationModal() {
    const modal = document.getElementById('voterVerificationModal');
    modal.classList.add('hidden');
    document.getElementById('voterVerificationForm').reset();
    document.getElementById('verificationResult').classList.add('hidden');
}

function verifyVoter() {
    const form = document.getElementById('voterVerificationForm');
    const formData = new FormData(form);
    
    fetch(`/users/${currentUserId}/verify-voter`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(Object.fromEntries(formData))
    })
    .then(response => response.json())
    .then(data => {
        const resultDiv = document.getElementById('verificationResult');
        const successIcon = document.getElementById('successIcon');
        const errorIcon = document.getElementById('errorIcon');
        const message = document.getElementById('verificationMessage');
        
        resultDiv.classList.remove('hidden');
        
        if (data.status === 'success') {
            resultDiv.classList.remove('bg-red-50');
            resultDiv.classList.add('bg-green-50');
            successIcon.classList.remove('hidden');
            errorIcon.classList.add('hidden');
            message.classList.remove('text-red-800');
            message.classList.add('text-green-800');
            setTimeout(() => {
                hideVoterVerificationModal();
                window.location.reload();
            }, 2000);
        } else {
            resultDiv.classList.remove('bg-green-50');
            resultDiv.classList.add('bg-red-50');
            successIcon.classList.add('hidden');
            errorIcon.classList.remove('hidden');
            message.classList.remove('text-green-800');
            message.classList.add('text-red-800');
        }
        
        message.textContent = data.message;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
