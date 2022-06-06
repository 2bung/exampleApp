<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
                <a class="focus:bg-gray-50" href="{{ route('regenerate') }}">
                    <x-button class="ml-4">
                        {{ __('Регенерировать токен') }}
                    </x-button>
                </a>
                <form method="post" action="{{ route('quotation') }}">
                    @csrf
                    <div>
                        <x-label for="name" :value="__('Дата в формате ДМГ (d.m.y)')" />
                        <x-input id="name" class="block mt-1 w-full" type="date" name="date" value="" required autofocus />
                    </div>
                    <x-button class="ml-4">
                        {{ __('Отправить') }}
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
