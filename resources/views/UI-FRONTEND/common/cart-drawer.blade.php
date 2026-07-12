<cart-drawer class="portal portal--drawer" id="cart-drawer" data-type="drawer" data-animation="slide-in-right" style="--dialog-max-width:52rem">
  <dialog class="portal-dialog">
    <div class=" w-full h-full flex">
      <div class="portal-overlay"></div>
      <div class=" cart-drawer-related-products animation fade-in flex items-center justify-center" data-animation="fade-in" id="PortalClose-cart-related-drawer">
        <related-products class="cart-releated-products w-full fade-in dnone lg:block hidden" data-skip-search="1" data-limit="5">
          <carousel-slider>
            <div class="embla lg:pb-[var(--spacing-10)]">
              <h2 class="text-h4 text-center mb-5 font-semibold text-white">
                Sản phẩm gợi ý
              </h2>
              <div class="embla__viewport w-full overflow-hidden min-w-0">
                <div class="embla__container product-list flex h-inherit [&>div]:px-2 [&>div]:w-full md:[&>div]:w-[75%] xl:[&>div]:w-1/3 [&>div]:grow-0 [&>div]:shrink-0 [&>div:first-child]:ml-auto [&>div:last-child]:mr-auto"></div>
              </div>
              <div class="embla__buttons dnone md:block">
                <button class="embla__button embla__button--prev" onclick="event.stopPropagation()" type="button">
                  <i class="icon icon-carret-left"></i>
                </button>

                <button class="embla__button embla__button--next " onclick="event.stopPropagation()" type="button">
                  <i class="icon icon-carret-right"></i>
                </button>
              </div>
            </div>
          </carousel-slider>
        </related-products>
      </div>
      <div class="portal-inner w-full  bg-background animation  h-full">
        <cart-form class="h-full">
          <form class="cart-form h-full" action="/cart" method="post">
            <div class="cart grid grid-rows-[auto_1fr_auto]">
              <div class="portal-header pt-4 px-4 flex justify-between items-center border-b pb-3 border-neutral-50 px-4">
                <p class="text-h6 md:text-h4">Giỏ hàng</p>
                <button type="button" id="PortalClose-cart-crawer" class="w-[3.2rem] h-[3.2rem] rounded-full border border-neutral-50 text-neutral-200 flex items-center justify-center active:scale-95 transition-transform hover:bg-neutral-50">
                  <i class="icon icon-cross"> </i>
                </button>
              </div>
              <div class="cart-left p-4 overflow-y-auto flex flex-col">
                <rewards-bar> </rewards-bar>
                <div class="cart-table"></div>
                <div class="lg:hidden w-full mt-auto">
                  <related-products class="cart-releated-products hidden" data-skip-search="1" data-product-type="row">
                    <div class=" mb-2">
                      <h2 class="text-base font-semibold">
                        Sản phẩm gợi ý
                      </h2>
                    </div>
                    <div class="overflow-hidden">
                      <div class="flex overflow-x-auto no-scrollbar product-list [&>div]:flex-grow-0  [&>div]:flex-shrink-0  [&>div]:w-[75%] gap-2 ">
                      </div>
                    </div>
                  </related-products>
                </div>
              </div>
              <div class="cart-right p-4 border-t border-neutral-50 bg-background">
                <div class="cart-summary"></div>
              </div>
              <div class="cart-empty"></div>
            </div>
          </form>
        </cart-form>
      </div>
    </div>
  </dialog>
</cart-drawer>
