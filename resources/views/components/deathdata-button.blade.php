    <!-- Modal Import Contact One by One-->
    <div
        x-data="{
            deathdata: {
                id: null,
                fullname: null,
                family_card_id: null,
                family_card_number: null,
                NIK: null,
                religion: null,
                birth_place: null,
                birthdate: null,
                deathdate: null,
                address: null
            },
            show: false,
            close() {
                this.show = false,
                this.deathdata = {
                    id: null,
                    fullname: null,
                    family_card_id: null,
                    family_card_number: null,
                    NIK: null,
                    religion: null,
                    birth_place: null,
                    birthdate: null,
                    deathdate: null,
                    address: null
                }
            },
            open() {
                this.show = true
            }
        }"
        @keydown.escape="close"
    >
        <section class="flex flex-wrap">
            <button class="flex border px-3 py-1 text-sm gap-1 items-center rounded-md text-green-600 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-200" x-on:click="open">
                <svg class="icon icon-plus-circle fill-current text-green-600" width="18" height="18"><use xlink:href="#icon-plus-circle"></use>
                    <symbol id="icon-plus-circle" viewBox="0 0 24 24">
                        <path d="M23 12c0-3.037-1.232-5.789-3.222-7.778s-4.741-3.222-7.778-3.222-5.789 1.232-7.778 3.222-3.222 4.741-3.222 7.778 1.232 5.789 3.222 7.778 4.741 3.222 7.778 3.222 5.789-1.232 7.778-3.222 3.222-4.741 3.222-7.778zM21 12c0 2.486-1.006 4.734-2.636 6.364s-3.878 2.636-6.364 2.636-4.734-1.006-6.364-2.636-2.636-3.878-2.636-6.364 1.006-4.734 2.636-6.364 3.878-2.636 6.364-2.636 4.734 1.006 6.364 2.636 2.636 3.878 2.636 6.364zM8 13h3v3c0 0.552 0.448 1 1 1s1-0.448 1-1v-3h3c0.552 0 1-0.448 1-1s-0.448-1-1-1h-3v-3c0-0.552-0.448-1-1-1s-1 0.448-1 1v3h-3c-0.552 0-1 0.448-1 1s0.448 1 1 1z"></path>
                        </symbol>
                </svg>
                New Death Data
            </button>

            <!-- overlay -->
            <div
                class="overflow-auto"
                style="background-color: rgba(0,0,0,0.5)"
                :class="{ 'fixed inset-0 z-30 flex items-center justify-center': show }"
                x-show="show"
                x-cloak
            >
                <!-- dialog -->
                <div
                    class="bg-white shadow-2xl sm:m-8 rounded-md"
                    x-show="show"
                    @click.away="close"
                >
                    <div class="flex justify-between items-center border-b text-lg px-6 py-3">
                        <h6 class="text-xl font-bold">Add New Death Data</h6>
                        <button type="button" @click="close">✖</button>
                    </div>
                    <form actions="{{route('death_data.store')}}" method="POST">
                    <template x-on:update-deathdata.window="deathdata = $event.detail.data; open(); console.log($event.detail.data)"></template>
                        @csrf
                        <div class="flex gap-10 px-6 py-10">
                            <div class="grid grid-cols-4 gap-4">
                                <input x-model="deathdata.id" type="hidden" name="family_card_id" placeholder="" value="">
                                <div class="flex items-center">
                                    <label for="name">Nama Lengkap</label>
                                    <span class="text-red-500 text-sm">*</span>
                                </div>
                                <div class="grid col-span-3">
                                    <input x-model="deathdata.fullname" class="rounded-md border border-gray-300 p-2" type="text" name="fullname" id="fullname" placeholder="John Scarlett" value="{{ old('fullname') }}">

                                    @error('fullname')
                                        <div class="text-red-400 text-xs">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="flex items-center">
                                    <label for="number">No. Kartu Keluarga</label>
                                    <span class="text-red-500 text-sm">*</span>
                                </div>
                                <div class="grid col-span-3">
                                    {{-- <input x-model="deathdata.family_card_number" class="rounded-md border border-gray-300 p-2" type="text" name="family_card_number" id="family_card_number" placeholder="6421xxxxxxxxx" value="{{ old('family_card_number') }}"> --}}

                                    {{-- @livewire('component.death-data-select-input-component', ['label' => 'No. Kartu Keluarga', 'name' => 'family_card_id']) --}}

                                    

                                    <livewire:component.death-data-select-input-component label='No. Kartu Keluarga' name='family_card_id'/>
                                    @error('family_card_id')
                                        <div class="text-red-400 text-xs">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="flex items-center">
                                    <label for="provider_id">NIK</label>
                                    <span class="text-red-500 text-sm">*</span>
                                </div>
                                <div class="grid col-span-3">
                                    <input x-model="deathdata.NIK" class="rounded-md border border-gray-300 p-2" type="text" name="NIK" id="NIK" placeholder="6421xxxxxxxx" value="{{ old('NIK') }}">

                                    @error('NIK')
                                        <div class="text-red-400 text-xs">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="flex items-center">
                                    <label for="department">Agama</label>
                                    <span class="text-red-500 text-sm">*</span>
                                </div>
                                <div class="grid col-span-3">
                                    <select x-model="deathdata.religion" name="religion" id="religion" class="rounded-md border border-gray-300 p-2">
                                        <option value="Islam">
                                            Islam
                                        </option>
                                        <option value="Kristen">
                                            Kristen
                                        </option>
                                        <option value="Budha">
                                            Budha
                                        </option>
                                        <option value="Hindu">
                                            Hindu
                                        </option>
                                        <option value="Konghucu">
                                            Konghucu
                                        </option>
                                        <option value="Katolik">
                                            Katolik
                                        </option>
                                    </select>
                                    @error('religion')
                                        <div class="text-red-400 text-xs">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="flex items-center">
                                    <label for="employee_status">Tempat Lahir</label>
                                    <span class="text-red-500 text-sm">*</span>
                                </div>
                                <div class="grid col-span-3">
                                    <input x-model="deathdata.birth_place" class="rounded-md border border-gray-300 p-2" type="text" name="birth_place" id="birth_place" placeholder="Penajam" value="{{ old('birth_place') }}">

                                    @error('birth_place')
                                        <div class="text-red-400 text-xs">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex items-center">
                                    <label for="employee_status">Tanggal Lahir</label>
                                    <span class="text-red-500 text-sm">*</span>
                                </div>
                                <div class="grid col-span-3">
                                    <input x-model="deathdata.birthdate" class="rounded-md border border-gray-300 p-2" type="date" name="birthdate" id="birthdate" value="{{ old('birthdate') }}">

                                    @error('birthdate')
                                        <div class="text-red-400 text-xs">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex items-center">
                                    <label for="employee_status">Tanggal Kematian</label>
                                    <span class="text-red-500 text-sm">*</span>
                                </div>
                                <div class="grid col-span-3">
                                    <input x-model="deathdata.deathdate" class="rounded-md border border-gray-300 p-2" type="date" name="deathdate" id="deathdate" value="{{ old('deathdate') }}">

                                    @error('deathdate')
                                        <div class="text-red-400 text-xs">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex items-center">
                                    <label for="employee_status">Alamat</label>
                                    <span class="text-red-500 text-sm">*</span>
                                </div>
                                <div class="grid col-span-3">
                                    <input x-model="deathdata.address" class="rounded-md border border-gray-300 p-2" type="text" name="address" id="address" placeholder="Jln. xxxxxxxxxx" value="{{ old('address') }}">

                                    @error('address')
                                        <div class="text-red-400 text-xs">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end items-center border-t text-lg px-6 py-3">
                            <button type="submit" class="bg-green-500 px-6 py-2 rounded-md text-white font-semibold focus:outline-none focus:ring-2 focus:ring-blue-200">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /dialog -->
            </div>
            <!-- /overlay -->
        </section>
        <main
            x-data="{ selectedId: @entangle('selected'), deletingState: false, deleteConfirmState: false}"
            @keydown.escape="deletingState = false"
            x-on:show-confirmation.window="selectedId = event.detail.selectedIds; deletingState = true"
            >
            @if(count($this->selected) >= 1)
            <section class="flex flex-wrap">
                <button class="flex border px-3 py-1 text-sm gap-1 items-center rounded-md text-red-600 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-200" @click="deletingState = true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="18" height="18">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Delete Selected
                </button>

                <!-- overlay -->
                <div
                    class="overflow-auto"
                    style="background-color: rgba(0,0,0,0.5)"
                    :class="{ 'fixed inset-0 z-40 flex items-center justify-center': deletingState }"   
                >
                    <!-- dialog -->
                    <div
                        class="bg-white shadow-2xl m-4 sm:m-8 rounded-md"
                        x-show="deletingState"
                        @click.away="deletingState = false"
                    >
                        <div class="flex justify-between items-center border-b text-lg px-6 py-3">
                            <h6 class="text-xl font-bold">Delete Confirmation</h6>
                            <button type="button" x-on:click="deletingState = false;">✖</button>
                        </div>
                        <div class="flex gap-10 px-6 py-10">
                            <div class=" w-full items-center justify-center bg-grey-lighter">
                                <h4>Yakin nih mau hapus Data Kematian ini ?</h4>
                            </div>
                        </div>
                        <div class="flex justify-end items-center border-t text-lg px-6 py-3">
                            <button type="button" 
                                    class="bg-green-500 px-6 py-2 rounded-md text-white font-semibold focus:outline-none focus:ring-2 focus:ring-blue-200 grid mr-5"
                                    :class="deleteConfirmState ? 'grid-cols-2 px-6 cursor-not-allowed disabled:opacity-40' : 'px-10'"
                                    x-on:click="deleteConfirmState = true; $wire.deleteDeathdata(selectedId);"
                                    x-bind:disabled="deleteConfirmState"
                                >
                                <svg x-show="deleteConfirmState" class="z-10 animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24">
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Yes
                            </button>
                            <button class="px-6 py-2 rounded-md text-red-600 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-200 grid" 
                                x-on:click="deletingState = false;">
                                No
                            </button>
                        </div>
                        <div ></div>
                    </div>
                    <!-- /dialog -->
                </div>
                <!-- /overlay -->
            </section>
            @endif
        </main>
    </div>