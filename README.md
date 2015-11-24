# siriusphp\html benchmark

This repo is set up to compare Sirius\Html library against Twig

The benchmark results are as follows

| Library               | Time    | Memory|
|-----------------------|--------:|------:|
| Twig                  | 0.55s   | 1.3Mb |
| Sirius - optimized    | 0.74s   | 0.5Mb |
| Sirius - not optimized| 1.55s   | 0.5Mb |

The non-optimized version of the Sirius\Html implementation builds the component at render time.

The optimized version of the Sirius\Html implementation builds the component at construction. But this is not a real-world scenario since the HTML components are hardly ever reused.

