{{--
    Liens vers tes réseaux, à éditer directement ici si besoin.
--}}
@props([
    'links' => [
        ['label' => 'GitHub', 'href' => 'https://github.com/Homevo24', 'icon' => 'github'],
        ['label' => 'LinkedIn', 'href' => 'https://www.linkedin.com/in/l%C3%A9ger-gnahoui-b38a63280/', 'icon' => 'linkedin'],
        ['label' => 'E-mail', 'href' => 'mailto:admin@example.com', 'icon' => 'mail'],
        ['label' => 'Telegram', 'href' => 'https://t.me/legerGna', 'icon' => 'send'],
        ['label' => 'Facebook', 'href' => 'https://facebook.com/legergael.gnahoui.3', 'icon' => 'facebook'],
        ['label' => 'Instagram', 'href' => 'https://www.instagram.com/lger90?stkn=MTQ0Ymhwc2Nlc3N4NQ%3D%3D&utm_source=qr', 'icon' => 'instagram'],
    ],
])

<footer class="mx-auto mt-10 max-w-6xl px-6 pb-16">
    <div class="flex flex-col items-center justify-between gap-8 md:flex-row">
        <p class="font-display text-2xl font-semibold text-paper md:text-3xl">
            Avez-vous un projet&nbsp;? Discutons
        </p>

        <div class="flex flex-wrap items-center justify-center gap-3">
            @foreach ($links as $link)
                <a
                    href="{{ $link['href'] }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="{{ $link['label'] }}"
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-paper/30 bg-ink text-paper transition hover:border-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink"
                >
                    @switch($link['icon'])
                        @case('github')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <g fill="none">
                                    <g clip-path="url(#footer-github-clip)">
                                        <path fill="currentColor" fill-rule="evenodd" d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385c.6.105.825-.255.825-.57c0-.285-.015-1.23-.015-2.235c-3.015.555-3.795-.735-4.035-1.41c-.135-.345-.72-1.41-1.23-1.695c-.42-.225-1.02-.78-.015-.795c.945-.015 1.62.87 1.845 1.23c1.08 1.815 2.805 1.305 3.495.99c.105-.78.42-1.305.765-1.605c-2.67-.3-5.46-1.335-5.46-5.925c0-1.305.465-2.385 1.23-3.225c-.12-.3-.54-1.53.12-3.18c0 0 1.005-.315 3.3 1.23c.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23c.66 1.65.24 2.88.12 3.18c.765.84 1.23 1.905 1.23 3.225c0 4.605-2.805 5.625-5.475 5.925c.435.375.81 1.095.81 2.22c0 1.605-.015 2.895-.015 3.3c0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12" clip-rule="evenodd" />
                                    </g>
                                    <defs>
                                        <clipPath id="footer-github-clip">
                                            <path fill="#fff" d="M0 0h24v24H0z" />
                                        </clipPath>
                                    </defs>
                                </g>
                            </svg>
                            @break

                        @case('linkedin')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1046.16 1000" class="h-5 w-5">
                                <path d="M0 0h1046.16v1000H0z" fill="none" />
                                <path fill="currentColor" d="M237.485 1000V325.301H13.229V1000zM125.386 233.127c78.202 0 126.879-51.809 126.879-116.553C250.808 50.37 203.591-.001 126.87-.001C50.161-.001-.002 50.371-.002 116.574c0 64.747 48.665 116.553 123.924 116.553h1.457zM361.61 1000h224.256V623.215c0-20.165 1.457-40.309 7.379-54.724c16.212-40.289 53.111-82.017 115.06-82.017c81.149 0 113.613 61.872 113.613 152.572v360.949h224.242V613.129c0-207.241-110.636-303.668-258.183-303.668c-120.977 0-174.094 67.622-203.603 113.679h1.497v-97.853H361.615c2.943 63.31 0 674.699 0 674.699z" />
                            </svg>
                            @break

                        @case('mail')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36" class="h-5 w-5">
                                <path d="M0 0h36v36H0z" fill="none" />
                                <path fill="currentColor" d="M32.33 6a2 2 0 0 0-.41 0h-28a2 2 0 0 0-.53.08l14.45 14.39Z" />
                                <path fill="currentColor" d="m33.81 7.39l-14.56 14.5a2 2 0 0 1-2.82 0L2 7.5a2 2 0 0 0-.07.5v20a2 2 0 0 0 2 2h28a2 2 0 0 0 2-2V8a2 2 0 0 0-.12-.61M5.3 28H3.91v-1.43l7.27-7.21l1.41 1.41Zm26.61 0h-1.4l-7.29-7.23l1.41-1.41l7.27 7.21Z" />
                                <path fill="none" d="M0 0h36v36H0z" />
                            </svg>
                            @break

                        @case('send')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor" fill-rule="evenodd" d="M18.483 19.79v-.002l.018-.043L21.5 4.625v-.048c0-.377-.14-.706-.442-.903c-.265-.173-.57-.185-.784-.169a2.7 2.7 0 0 0-.586.12a3 3 0 0 0-.24.088l-.013.005l-16.72 6.559l-.005.002a1 1 0 0 0-.149.061a2.3 2.3 0 0 0-.341.19c-.215.148-.624.496-.555 1.048c.057.458.372.748.585.899a2 2 0 0 0 .403.22l.032.014l.01.003l.007.003l2.926.985q-.016.276.057.555l1.465 5.559a1.5 1.5 0 0 0 2.834.196l2.288-2.446l3.929 3.012l.056.024c.357.156.69.205.995.164c.305-.042.547-.17.729-.315a1.74 1.74 0 0 0 .49-.635l.008-.017l.003-.006zM7.135 13.875a.3.3 0 0 1 .13-.33l9.921-6.3s.584-.355.563 0c0 0 .104.062-.209.353c-.296.277-7.071 6.818-7.757 7.48a.3.3 0 0 0-.077.136L8.6 19.434z" clip-rule="evenodd" />
                            </svg>
                            @break

                        @case('facebook')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor" d="M14.2 2.875A4.625 4.625 0 0 0 9.575 7.5v2.575H7.1c-.124 0-.225.1-.225.225v3.4c0 .124.1.225.225.225h2.475V20.9c0 .124.1.225.225.225h3.4c.124 0 .225-.1.225-.225v-6.975h2.497c.103 0 .193-.07.218-.17l.85-3.4a.225.225 0 0 0-.218-.28h-3.347V7.5a.775.775 0 0 1 .775-.775h2.6c.124 0 .225-.1.225-.225V3.1c0-.124-.1-.225-.225-.225z" />
                            </svg>
                            @break

                        @case('instagram')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor" fill-rule="evenodd" d="M7.465 1.066C8.638 1.012 9.012 1 12 1s3.362.013 4.534.066s1.972.24 2.672.511c.733.277 1.398.71 1.948 1.27c.56.549.992 1.213 1.268 1.947c.272.7.458 1.5.512 2.67C22.988 8.639 23 9.013 23 12s-.013 3.362-.066 4.535c-.053 1.17-.24 1.97-.512 2.67a5.4 5.4 0 0 1-1.268 1.949c-.55.56-1.215.992-1.948 1.268c-.7.272-1.5.458-2.67.512c-1.174.054-1.548.066-4.536.066s-3.362-.013-4.535-.066c-1.17-.053-1.97-.24-2.67-.512a5.4 5.4 0 0 1-1.949-1.268a5.4 5.4 0 0 1-1.269-1.948c-.271-.7-.457-1.5-.511-2.67C1.012 15.361 1 14.987 1 12s.013-3.362.066-4.534s.24-1.972.511-2.672a5.4 5.4 0 0 1 1.27-1.948a5.4 5.4 0 0 1 1.947-1.269c.7-.271 1.5-.457 2.67-.511m8.98 1.98c-1.16-.053-1.508-.064-4.445-.064s-3.285.011-4.445.064c-1.073.049-1.655.228-2.043.379c-.513.2-.88.437-1.265.822a3.4 3.4 0 0 0-.822 1.265c-.151.388-.33.97-.379 2.043c-.053 1.16-.064 1.508-.064 4.445s.011 3.285.064 4.445c.049 1.073.228 1.655.379 2.043c.176.477.457.91.822 1.265c.355.365.788.646 1.265.822c.388.151.97.33 2.043.379c1.16.053 1.507.064 4.445.064s3.285-.011 4.445-.064c1.073-.049 1.655-.228 2.043-.379c.513-.2.88-.437 1.265-.822c.365-.355.646-.788.822-1.265c.151-.388.33-.97.379-2.043c.053-1.16.064-1.508.064-4.445s-.011-3.285-.064-4.445c-.049-1.073-.228-1.655-.379-2.043c-.2-.513-.437-.88-.822-1.265a3.4 3.4 0 0 0-1.265-.822c-.388-.151-.97-.33-2.043-.379m-5.85 12.345a3.669 3.669 0 0 0 4-5.986a3.67 3.67 0 1 0-4 5.986M8.002 8.002a5.654 5.654 0 1 1 7.996 7.996a5.654 5.654 0 0 1-7.996-7.996m10.906-.814a1.337 1.337 0 1 0-1.89-1.89a1.337 1.337 0 0 0 1.89 1.89" clip-rule="evenodd" />
                            </svg>
                            @break
                    @endswitch
                </a>
            @endforeach
        </div>
    </div>
</footer>
