<div class="w-full overflow-x-auto">
    <table class="w-full text-left border border-separate rounded border-slate-200" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"
                    class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                    Nama</th>
                <th scope="col"
                    class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                    Kelas</th>
                <th scope="col"
                    class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                    Alat Dipinjam</th>
                <th scope="col"
                    class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                    Tenggat Pengembalian</th>
                @if ($status === 'Dikembalikan')
                    <th scope="col"
                        class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                        Tanggal Pengembalian</th>
                @endif
                <th scope="col"
                    class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                    Catatan</th>
                <th scope="col"
                    class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                    Status</th>
                <th scope="col"
                    class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                    Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (empty($borrows))
                <tr class="transition-colors duration-300 hover:bg-slate-50">
                    <td colspan="{{ $status === 'Dikembalikan' ? 8 : 7 }}"
                        class="h-12 text-center px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                        Tidak ada data</td>
                </tr>
            @else
                @foreach ($borrows as $borrow)
                    <tr class="transition-colors duration-300 hover:bg-slate-50">
                        <td
                            class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                            {{ $borrow['student']['name'] ?? '-' }}</td>
                        <td
                            class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                            {{ $borrow['student']['class']['class_name'] ?? '-' }}</td>
                        <td
                            class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                            @foreach ($borrow['items'] as $item)
                                <li>{{ $item['name'] }} (x{{ $item['pivot']['quantity'] }})</li>
                            @endforeach
                        </td>
                        <td
                            class="h-12 w-40 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                            {{ date('d-m-Y H:i', strtotime($borrow['due_at'])) }}</td>
                        @if ($status === 'Dikembalikan')
                            <td
                                class="h-12 w-40 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                {{ date('d-m-Y H:i', strtotime($borrow['returned_at'])) }}</td>
                        @endif
                        <td
                            class="h-12 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                            {{ $borrow['notes'] ?? '-' }}</td>
                        <td
                            class="h-12 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500">
                            <span
                                class="inline-flex items-center justify-center gap-1 rounded px-2 py-1 text-sm shadow-xs font-medium
                                    @if ($borrow['status'] == 'returned') bg-green-100 text-green-500
                                    @elseif ($borrow['status'] == 'request') bg-blue-100 text-blue-500
                                    @elseif ($borrow['status'] == 'borrowed') bg-yellow-100 text-yellow-500
                                    @else bg-red-100 text-red-500 @endif">
                                @if ($borrow['status'] == 'returned')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="9" />
                                            <path d="m8 12l3 3l5-6" />
                                        </g>
                                    </svg>
                                @elseif ($borrow['status'] == 'request')
                                    <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" aria-live="polite" aria-busy="true">
                                        <path d="M7 10H3V14H7V10Z" class="fill-blue-500 animate animate-bounce " />
                                        <path d="M14 10H10V14H14V10Z"
                                            class="fill-blue-500 animate animate-bounce  [animation-delay:.2s]" />
                                        <path d="M21 10H17V14H21V10Z"
                                            class="fill-blue-500 animate animate-bounce  [animation-delay:.4s]" />
                                    </svg>
                                @elseif ($borrow['status'] == 'borrowed')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" viewBox="0 0 24 24">
                                        <g>
                                            <path fill="currentColor" d="M7 3H17V7.2L12 12L7 7.2V3Z">
                                                <animate id="eosIconsHourglass0" fill="freeze" attributeName="opacity"
                                                    begin="0;eosIconsHourglass1.end" dur="2s" from="1"
                                                    to="0" />
                                            </path>
                                            <path fill="currentColor" d="M17 21H7V16.8L12 12L17 16.8V21Z">
                                                <animate fill="freeze" attributeName="opacity"
                                                    begin="0;eosIconsHourglass1.end" dur="2s" from="0"
                                                    to="1" />
                                            </path>
                                            <path fill="currentColor" class="text-yellow-300"
                                                d="M6 2V8H6.01L6 8.01L10 12L6 16L6.01 16.01H6V22H18V16.01H17.99L18 16L14 12L18 8.01L17.99 8H18V2H6ZM16 16.5V20H8V16.5L12 12.5L16 16.5ZM12 11.5L8 7.5V4H16V7.5L12 11.5Z" />
                                            <animateTransform id="eosIconsHourglass1" attributeName="transform"
                                                attributeType="XML" begin="eosIconsHourglass0.end" dur="0.5s"
                                                from="0 12 12" to="180 12 12" type="rotate" />
                                        </g>
                                    </svg>
                                @endif
                                {{ $borrow['status'] == 'returned' ? 'Kembali' : ($borrow['status'] == 'borrowed' ? 'Dipinjam' : 'Request') }}
                            </span>
                        </td>
                        <td
                            class="h-12 w-10 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                            <div class="inline-flex overflow-hidden rounded">
                                <a href="{{ route('borrows.destroy', $borrow['id']) }}" data-confirm-delete="true"
                                    class="inline-flex items-center self-center justify-center h-10 gap-2 px-5 text-sm font-medium tracking-wide transition duration-300 justify-self-center whitespace-nowrap bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-600 focus:bg-red-200 focus:text-red-700 focus-visible:outline-none disabled:cursor-not-allowed disabled:border-red-300 disabled:bg-red-100 disabled:text-red-400 disabled:shadow-none cursor-pointer">
                                    <span class="relative only:-mx-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"
                                                d="m19.5 5.5l-.62 10.025c-.158 2.561-.237 3.842-.88 4.763a4 4 0 0 1-1.2 1.128c-.957.584-2.24.584-4.806.584c-2.57 0-3.855 0-4.814-.585a4 4 0 0 1-1.2-1.13c-.642-.922-.72-2.205-.874-4.77L4.5 5.5M3 5.5h18m-4.944 0l-.683-1.408c-.453-.936-.68-1.403-1.071-1.695a2 2 0 0 0-.275-.172C13.594 2 13.074 2 12.035 2c-1.066 0-1.599 0-2.04.234a2 2 0 0 0-.278.18c-.395.303-.616.788-1.058 1.757L8.053 5.5m1.447 11v-6m5 6v-6"
                                                color="currentColor" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
</div>
