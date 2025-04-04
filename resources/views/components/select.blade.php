<select
        {{ $attributes->merge(["class" => "block mt-1 w-full pl-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"])}}>
        {{ $slot }}
</select>