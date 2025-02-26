<x-app-layout>
    {{-- Title --}}
    <x-slot name="title">Create User</x-slot>


    {{-- Header Style --}}
    <x-slot name="headerstyle">
    </x-slot>

    {{-- Page Content --}}
    <div class="flex flex-col gap-6">

        <div class="card max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
                <div class="">
                    <h2 class="text-2xl font-bold text-center mb-6">Send SMS</h2>

                    <!-- Tabs for switching between SMS types -->
                    <div class="flex justify-center space-x-4 mb-4">
                        <button class="tab-btn active bg-blue-500 text-white px-4 py-2 rounded-md" data-tab="single">Single SMS</button>
                        <button class="tab-btn bg-gray-300 px-4 py-2 rounded-md" data-tab="bulk">Bulk SMS</button>
                        <button class="tab-btn bg-gray-300 px-4 py-2 rounded-md" data-tab="dynamic">Dynamic SMS</button>
                    </div>

                    <!-- Single SMS Form -->
                    <form id="singleSmsForm" class="sms-form">
                        @csrf
                        <label class="block font-semibold">Phone Number:</label>
                        <input type="text" name="phone" class="w-full border p-2 rounded mt-1" placeholder="8801XXXXXXXXX" required>

                        <label class="block font-semibold mt-4">Message:</label>
                        <textarea name="message" class="w-full border p-2 rounded mt-1" placeholder="Enter your message..." required></textarea>

                        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded mt-4">Send SMS</button>
                    </form>

                    <!-- Bulk SMS Form -->
                    <form id="bulkSmsForm" class="sms-form hidden">
                        @csrf
                        <label class="block font-semibold">Phone Numbers (comma-separated):</label>
                        <input type="text" name="phones" class="w-full border p-2 rounded mt-1" placeholder="8801XXXXXXXXX, 8801YYYYYYYY" required>

                        <label class="block font-semibold mt-4">Message:</label>
                        <textarea name="message" class="w-full border p-2 rounded mt-1" placeholder="Enter your message..." required></textarea>

                        <button type="submit" class="w-full bg-green-500 text-white py-2 rounded mt-4">Send Bulk SMS</button>
                    </form>

                    <!-- Dynamic SMS Form -->
                    <form id="dynamicSmsForm" class="sms-form hidden">
                        @csrf
                        <div id="dynamic-fields">
                            <div class="dynamic-entry">
                                <label class="block font-semibold">Phone Number:</label>
                                <input type="text" name="msisdn[]" class="w-full border p-2 rounded mt-1" placeholder="8801XXXXXXXXX" required>

                                <label class="block font-semibold mt-2">Message:</label>
                                <textarea name="text[]" class="w-full border p-2 rounded mt-1" placeholder="Enter your message..." required></textarea>
                            </div>
                        </div>

                        <button type="button" id="addDynamicField" class="w-full bg-yellow-500 text-white py-2 rounded mt-4">+ Add More</button>
                        <button type="submit" class="w-full bg-purple-500 text-white py-2 rounded mt-4">Send Dynamic SMS</button>
                    </form>

                    <!-- Success/Error Messages -->
                    <div id="responseMessage" class="mt-4 text-center"></div>
                </div>
        </div> <!-- end card -->



    </div>


    <x-slot name="script">
        <script>
            $(document).ready(function () {
                // Tab switching
                $(".tab-btn").click(function () {
                    $(".tab-btn").removeClass("bg-blue-500 text-white").addClass("bg-gray-300");
                    $(this).removeClass("bg-gray-300").addClass("bg-blue-500 text-white");

                    $(".sms-form").addClass("hidden");
                    $("#" + $(this).data("tab") + "SmsForm").removeClass("hidden");
                });

                // Dynamic SMS: Add more fields
                $("#addDynamicField").click(function () {
                    $("#dynamic-fields").append(`
                        <div class="dynamic-entry mt-4">
                            <label class="block font-semibold">Phone Number:</label>
                            <input type="text" name="msisdn[]" class="w-full border p-2 rounded mt-1" placeholder="8801XXXXXXXXX" required>

                            <label class="block font-semibold mt-2">Message:</label>
                            <textarea name="text[]" class="w-full border p-2 rounded mt-1" placeholder="Enter your message..." required></textarea>
                        </div>
                    `);
                });

                // Form submission handlers
                $(".sms-form").submit(function (e) {
                    e.preventDefault();
                    let form = $(this);
                    let actionUrl = "";

                    if (form.attr("id") === "singleSmsForm") {
                        actionUrl = "/sms/send-single";
                    } else if (form.attr("id") === "bulkSmsForm") {
                        actionUrl = "/sms/send-bulk";
                    } else if (form.attr("id") === "dynamicSmsForm") {
                        actionUrl = "/sms/send-dynamic";
                    }

                    $.ajax({
                        url: actionUrl,
                        method: "POST",
                        data: form.serialize(),
                        success: function (response) {
                            $("#responseMessage").html(`<p class="text-green-600 font-semibold">✅ SMS Sent Successfully!</p>`);
                        },
                        error: function (xhr) {
                            let errorMessage = xhr.responseJSON?.message || "❌ Failed to send SMS.";
                            $("#responseMessage").html(`<p class="text-red-600 font-semibold">${errorMessage}</p>`);
                        }
                    });
                });
            });
        </script>
    </x-slot>
</x-app-layout>
