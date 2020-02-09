# Variables Modified

## Modifications on spacers
```
$spacer: 1rem !default;
$spacers: () !default;
// stylelint-disable-next-line scss/dollar-variable-default
$spacers: map-merge(
  (
    0: 0,
    1: ($spacer * .25),
    2: ($spacer * .5),
    3: $spacer,
    4: ($spacer * 1.5),
    5: ($spacer * 2),
    6: ($spacer * 2.5),
    7: ($spacer * 3),
    8: ($spacer * 3.5),
    9: ($spacer * 4),
    10: ($spacer * 4.5)
  ),
  $spacers
);
```
