    <!-- Modal Import Contact One by One-->
    <div
        x-data="{
            contact: {
                id: null,
                name: null,
                number: null,
                department: null,
                provider_id: null,
            },
            show: false,
            close() {
                this.show = false,
                this.contact = {
                    id: null,
                    name: null,
                    number: null,
                    department: null,
                    provider_id: null,
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
                New Family Card
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
                        <h6 class="text-xl font-bold">Add New Family Card</h6>
                        <button type="button" @click="close">✖</button>
                    </div>
                    <form actions="{{route('family_card.store')}}" method="POST">
                    <template x-on:update-contact.window="contact = $event.detail.data; open();"></template>
                        @csrf
                        <div class="flex gap-10 px-6 py-10">
                            <div class="grid grid-cols-4 gap-4">
                                <input x-model="family_cards.id" type="hidden" name="family_card_id" placeholder="" value="">
                                <div class="flex items-center">
                                    <label for="head_family_name">Nama Kepala Keluarga</label>
                                    <span class="text-red-500 text-sm">*</span>
                                </div>
                                <div class="grid col-span-3">
                                    <input x-model="family_cards.head_family_name" class="rounded-md border border-gray-300 p-2" type="text" name="head_family_name" id="fullname" placeholder="John Scarlett" value="{{ old('head_family_name') }}">

                                    @error('head_family_name')
                                        <div class="text-red-400 text-xs">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="flex items-center">
                                    <label for="family_card_number">No. Kartu Keluarga</label>
                                    <span class="text-red-500 text-sm">*</span>
                                </div>
                                <div class="grid col-span-3">
                                    <input x-model="family_cards.family_card_number" class="rounded-md border border-gray-300 p-2" type="text" name="family_card_number" id="family_card_number" placeholder="6421xxxxxxxxx" value="{{ old('family_card_number') }}">

                                    @error('family_card_number')
                                        <div class="text-red-400 text-xs">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="flex items-center">
                                    <label for="family_card_file">File Kartu Keluarga</label>
                                </div>
                                <div class="grid col-span-3">
                                    <input class="rounded-md border border-gray-300 p-2" type="file" name="family_card_file" id="family_card_file" placeholder="6421xxxxxxxx" value="{{ old('family_card_file') }}">

                                    @error('family_card_file')
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
    </div>