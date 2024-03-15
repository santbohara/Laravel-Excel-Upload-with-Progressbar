<div>

    <div class="overflow-x-auto">
        <p class="text-xs text-gray-600 text-right mb-1">Showing latest {{ $limit }} records.</p>
        <div class="shadow overflow-hidden border border-gray-200 sm:rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200" wire:poll.100ms>
                <thead class="bg-gray-100 text-xs">
                    <tr>
                        <th scope="col"
                            class="px-3 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">
                            Upload Details
                        </th>
                        <th scope="col"
                            class="px-3 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">

                        </th>
                        <th scope="col"
                            class="px-3 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">
                            Total rows
                        </th>
                        <th scope="col"
                            class="px-3 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50 divide-y divide-gray-200 text-xs">

                    @foreach ($in_progress as $upload)
                        <tr>
                            <td class="px-3 py-1 whitespace-nowrap text-gray-500">
                                <span>{{ $upload->file_name }}</span>
                                <p class="text-gray-400">{{ $upload->uploaded_at }}</p>
                            </td>
                            <?php
                                $percentage = 0;
                                if ($upload->total > 0) {
                                    $percentage = round($upload->current / ($upload->total / 100));
                                }
                            ?>
                            <td class="px-3 py-1 whitespace-nowrap text-gray-500">
                                <div class="relative pt-1">
                                    <div class="flex mb-2 items-center justify-between">
                                        <div>
                                            <span
                                                class="font-semibold inline-block py-1 px-3 rounded-full text-green-600 bg-green-200">
                                                {{ $upload->current }} Processed
                                            </span>
                                        </div>
                                        <div class="text-right px-3">
                                            <span class="font-semibold inline-block">
                                                {{ $percentage }}%
                                            </span>
                                        </div>
                                    </div>
                                    <div class="overflow-hidden h-2 mb-4 flex rounded bg-gray-200">
                                        <div style="width:{{ $percentage }}%"
                                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                        </div>

                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-1 whitespace-nowrap  text-gray-500">
                                {{ $upload->total }}
                            </td>
                            <td class="px-3 py-1 whitespace-nowrap">
                                <span
                                    class="px-3 inline-flex leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ ucfirst($upload->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    <!-- More people... -->
                </tbody>
            </table>
        </div>
    </div>
</div>
