<style>

.block-27 ul {
    padding: 0;
    margin: 0; }
    .block-27 ul li {
      display: inline-block;
      margin-bottom: 4px;
      font-weight: 400; }
      .block-27 ul li a, .block-27 ul li span {
        color: #FDD133;
        text-align: center;
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        border-radius: 50%;
        border: 1px solid #e6e6e6; }
      .block-27 ul li.active a, .block-27 ul li.active span {
        background: #FDD133;
        color: #fff;
        border: 1px solid transparent; }

</style>
@if($paginator->hasPages())
    <div class="row mt-3">
        <div class="col text-center">
            <div class="block-27">
                <ul class="pagination">
                    @if ($paginator->onFirstPage())
                        <li>
                            <a href="#" class=" disabled" aria-label="Previous">
                                <span aria-hidden="true">&lt;</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ $paginator->previousPageUrl() }}"class="" aria-label="Previous">
                                <span aria-hidden="true">&lt;</span>
                            </a>
                        </li>
                    @endif

                    @if (is_array($elements[0]))
                        @foreach ($elements[0] as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class=" active">
                                    <a href="{{ $url }}" class="active">{{ $page }}</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}" >{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif

                    @if ($paginator->hasMorePages())
                        <li>
                            <a href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&gt;</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a class="disabled" aria-label="Next"> <span aria-hidden="true">&gt;</span></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif




