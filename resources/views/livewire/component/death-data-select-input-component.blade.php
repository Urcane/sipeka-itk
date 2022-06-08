<div class="relative"
     x-data="{
            isVisible: false,
            deathdata: {
                family_card_id: null,
                family_card_number: null
            },
        }"
     @click.away="isVisible = false"
>
    <div class="flex flex-wrap flex-1 gap-1 mb-1">
        @foreach($selectedItems as $selected)
            <span
                class="transition-all bg-green-400 hover:bg-red-400 rounded p-1 text-sm text-white font-bold cursor-pointer"
                wire:click="remove({{$selected->id}})"
            >
                {{ $selected->family_card_number }} - {{$selected->head_family_name}}
            </span>
            <input type="hidden" name="{{$name}}[]" value="{{$selected->id}}">
        @endforeach
    </div>
    <template x-on:update-deathdata.window="deathdata = $event.detail.data;"></template>
    <input
        x-model="deathdata.family_card_number"
        wire:model="searchText"
        @focus="isVisible = true"
        type="text"
        class="rounded-md border border-gray-300 p-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full mb-1"
        placeholder="6471xxxxxxx"
    >
    <div x-show="isVisible"
            style="display: none"
            class="absolute w-full max-h-40 overflow-scroll border-b border-gray-300 overscroll-contain bg-white border rounded-md p-2">
        @foreach($items as $item)
            <div
                class="w-full bg-gray-100 p-1 mb-1 rounded-md hover:bg-gray-200 cursor-pointer pl-2 font-semibold"
                wire:click="choose({{$item->id}})"
                @click="isVisible = false"
            >
                - {{$item->family_card_number}}
            </div>
        @endforeach
    </div>
</div>
