<script setup>
    import Checkbox from '@/Components/Checkbox.vue';
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';

    const props = defineProps({
        canResetPassword: {
            type: Boolean,
        },
        status: {
            type: String,
        },
        test: {
            type: String,
        },
    });

    console.log('test ',props.test);

    const form = useForm({
        login: '',
        password: ''
    });

    const submit = () => {
        form.post(route('login'), {
            onFinish: () => form.reset('password'),
        });
    };
</script>

<template>
    <Head title="Login" />
    <div class="min-h-screen flex">
        <!-- Left Side -->
        <div
            class="hidden lg:flex lg:w-1/2 bg-green-800 relative overflow-hidden"
        >
            <div
                class="absolute inset-0 bg-gradient-to-br from-green-900 to-green-700"
            ></div>

            <div class="relative z-10 flex flex-col justify-center px-16 text-white">
                <div
                    class="inline-flex items-center gap-3 mb-6"
                >
                    <div>
                        <Link href="/">
                        
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABjCAYAAAAM/4euAAAACXBIWXMAACHVAAAh1QEEnLSdAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAADg5SURBVHja3H13eJRl1v5JnUyfOWdmggV1sWIv6IpdbKDSe3qfSSYNQgIJoYfQQ0hC7016r9I7UkSxt7WsHXUV3VXXdb1/f5x3mKAU9dtvv90f1/VcXAlhMu95TrnPfcoQ/Y4/0S2iyV5hJ3OqmdjvImfAQuZ0E9ky7eT2u8mR5yBnrp1sbaxkSbUQ57vJGXSQPcdGjhQ72f02cubayVvgIWuu200BbkMdnMXUxTWTMmQzJbqfpix+O9rP30T7+RvK4j9Rd/dmSpLNlOKeQSlcSOmux8x+t9NTIOQMOMkcMBMXucmV5SBbipWkSMjut5Erz0nOdAc5M+xkz7eTtdRKsW1jyZJsIS5hsgbjyFQUTdSM/n1/frMACwwBZtvInmyjmGzHjZTsrKIUz6HYgPx4W19Bdq0HtbMFm5Yytq0SHFnHeHUz47XNjGPrGNvWCJ5ewWiYJcitEdxVKTDnyo+U4jlISe7BEVmW69xFbnJnOsiWbCUp/v9MgLY8h5VSnEXUg9/gAg9yxgo2LmN8sI3x5S7GR9sZz69nrF/KWPYUY+IsRtUUxrDJjLqZjCVPMdYuZRxdF/4/n+xg7FjJKK4VXFAsoFR5hXo6g+YUW5wU8X+/AB1tLGRKsbgpjWsp1fNjq8EebFkp+H4f45s9jF0rGWX1grsrBa58AWUJKNU4KQJKa/R16GQJbHmC2ysERbWCp5erMP+xn7F3NaP9cAGlyT8oRcaYsmxODjr++wTozHOQPdceQe2cwymR0XmEB29vYeAw49l1jIwxDEfQEFKKCsWSK/AUCmKzBZQhuLS3QPIFEZkCKRB4CwWeAoE7X2AONBJ2ssCcK+hWrReCQ4xPdzAyxnlAqQxK48G2FBu50kMCtP0nC9BG7HdRTJarDSXwX+4a6sXb2wR4lrF6MeOaMn1gShVEZQs4PyyY+CIVyuW9BNVTGd2qGT1GqPleVyYwBQReQ4CmHIE7GP6/ljxDmEmCS3oL5s5j4Ajj052Cx6s8oO7uE1GprlaOoI2spVYytTX9hwnQbyFLeizZsmwRlMCLY7M9WLZIgBfURzUrEVBCWJt8hYKLDW1z56tg4nIFrqDgo+2MmXMZlCFoUiRomMm4p1IQ7defpQzBiCmMpJEMyjSEXyjwFQgoXf+dkvQ1ly9i4Dhj1xqBO98DSnDNsfSxUly7WLImW/9zBOgKmCkmNe4GSvB89MAAD3CI8cN+xoODBNRTBecp1IfyFKhvmzGXUTWJQT0FXKCm3H+SAM8xLigQRAYE5kwB9RD4igwNTRPcWa4XM2a6arOnQBCRI3h4ECO/huEKCtwFgphsvbSb+wo+3s7AMUb3ER5Qquddetx0lS3V/J8gQAuJ30Ex2c4elMAYOd0DvMqYv5BPaUJsjmqcxxCeFKi5TZnLwDuMxGoVMiUJRk8X4BjDl68/8/gQxuRZjNvKGZQkeHyIIG00Y+dKxvYVDEozLiRD0KmKgecYvWv1+5aAoZGGnx05nYFXGfPme0BJDEpztePerv9bAVpT44gSneWU6cWO1QK85EaX4ao1UTmCq/oIOlQxfIVqfp4CNdPLegnu6Ceonc3Au4ykEQzqIvhDbwEOM8bPYFBbQaBOgPcYl/cRXFYsGDSRcXM/wex5jA+2Mqy56jevLxWkjFQoVD1VQN0E15YKOg8XNCtR/0k9Bff21wt6Y7sgNtMLynKV2fNN/wcCvC2anOU2ohRHVXSGB+/u0Af/Q7GAEo2bT1TNq5vJuKFMEJmjJuwICpr1FmSM0Z9vmMvAW4x+dfp/bu2r5t2hShAYx6hoYJgCgsqJjM7DGNRZUDJBgFcYdw7Qy2ozmNF6sOBvexjZYwWULRg5lYGXGL0nMCJyBM581XIOCE7sZnx7gNGkwANKdAyO6x317xWg6bYoogL3CHOuF1/sY5zYzbDk6Bv0FQnyawRl9QIOCpw5gvsrGSa/ETFzBTf1E5RPVD8VlyMYNoXRbpiAclR7qKcgJl8QmS6gjmEMaMrRiHt7hWDWPEabIYKOVYKEEQJ7rgBHGHMWMCRfsGUF47NdDHue4kYJRfoMfa3DGxk4JriqdzwoYBny7xFgLFGMO4LoPutAUy8fTuxlvLmNVePSBbag4NZ+jNeeZuAoA88wdq9Sn/XEEEMIAcG9Axh96xiWoCGcdhoQ/tBHkDBSkD6a0auWMXa6amDWGEbPkYIrSwWxAUPIHQXR2YL2wwW39BPcVi54dj3jkiLBtb0FeJmRNsq41EI9MX69hGjjsnetZeB5QdM+XtADtvK4G2OJov8X5Rd5ARH1dedQfjze28F4f7c6bMrU240vVN93/wBG9xGMtsMEW5YzcJDx+hZG02IVgC1XTY8yBU8MEyxeyHh3K+OLXQqC39/GeHkj49BaxosbGH/eqmnbX3ZpGrduKSNhpCHMLoLIVEHzfqrxlCH44gDjta16seZcNWnKEVzeW9B6sAozOltdxt51as72/k1AJZwQZf2tUrn8POcKUv9gJ6IbYu+nbA/2bhR8f4hhzlEhxGYLIrLUTNz5+qY7VzMuztYHjMsT9BypWkLdNTIPnKQC+XE/49h6RtVkxhNDBU2LNdDEGQHCFNCvLywSPDxIfeGB1Yzv9jL+tocxdQ5rHtxDtfiWCsFz6xnBGg1MlxYL7hkgeHCg4PNdBkJIVSFGZuv/eXM74+09hu9uaWkZGfNbBNjlPKeT/h2dH+2jLN+J+tke4LgbFxtwJL5I0HME46Z+jfLVDL3t8nrGbeWCiIAKjnoKgrWCnw6o4GqmMy7pFU7JKFO1ypqnwcYd1L+teUYkzQzDEk+hoF+94NMdmnVMms2IzTF+T7r+e64RhApqNLjgqAYbSm+U/WQKbDmCHw4xVq4WUO/49+myGAcREVl/xaHo8xwiirYTUYJ7c7caL/CqG48OCvsWShVMnsPAK4x9qxipo1gzhkxB7wmMx4fqQ11UIHh1MwPPM0ZO5VMmFJWjQDoEss93vAaWjPHre6B0QepowY8H1Oc+afw+SlNfekeFYsgtyxmfbGfE5KivbvxalCy4sUT9Zp+JXlBP16rIHkTUnYh6nOc40h3nPM40O1EPV+kF+R7gOKN6OoN6hN8AZQnurxSMm8rYspqBF/VBBk4ygksnQfthAhxnvLSZ0aRAMwRL7ukA+/ccX6FqKCWp1k+fqxc5dS6rRicr8XB1qeCfhxlTZuv3vY2yImvAAN2JAv84hT63VvpAKZZ8yiCinPMcLuazHneRm2yF7hspy4tnNjGOb9HbtOWF34A7X/3To4MYN/Vl3NVfIcY9/TVSltcz8Bpj1DQDI2ae/gD/ihNfaDA0PQQPDdR08PmNjMhMFe4dFZrO9ahWzQwBe+op6DSMkTnGCIaJgg0rGR/sFlCG90dKjL6KUogok4gyznJiesT88vSMoehu0RT7ZBRRN/fW/DrVvsuL9Q1wvr6JUyaQIiioYXQZzuqj0gXUVVA1lYE3GCmjVGvtef9zrTuraRcKpFC1TnIFXx9gfLaXYctRQV3WS9C8VDU2JketoFOV5tXHNzPMfn0Ou1/w/RE3xi7wgjq71kb4iMhMRK6znOjron95mkdT1DWRRB0tqfG9PPjxWUalkfhbcwVxARWiFAgu6SXgPMFNvQVjprEKtKugeAIDbzK6G6kdN+L0/jdPiHSIzBB8vJfx+X5GXLYKx5GnPxMXMCiv9xkDpjDcAcHgSaykRoIgaZQALzKuL/OB7orrGfVgBMW0j6GYJ395zgxdLiWKbBYRQ13kncVrPHh3l4Z+SheMnsbIHM2g7mo2sQFBca2mTBcbqVzrwZpqpY3W25eCf63J/iohZghiMgVf7Gcc3WT4xAyFSR9sU6CfNJJxR7lg4QLBl88wLi3RoEaJggPrGQc3CKjA85o5y0bW9laydbP94pC51PyLE1dqIiqy97+tvxd41ohsPVQIL29i4HXGsCmG3+gg6FVrfN1ZcHGBBozxM1XIIb7vtwrBmmcQrv8TIaYLnH4ldGcvVAuibEUN6dUCaivYvY7x9/2MgRMZlGWUFjIEN5YJ8Dyjc70PdKOlmOwGHr7sZ8eWaTvtWDOsZMuyuSnJ8/n2tXoTlKzpjymgIHnEFBXiS08zOlcJug43YEmS4NhmxnNPa7Cx5v12s5UCwQVFgksMLXLl/36/GV+kPvGeCrWI5FFqopQpyB7N+PGQUmAXpGs6aTcyGUtAn2XJEsabOzygHP6A7ogw02VE1PxnJyYYc9qJDkYRpdn631ep2vdApeKqpJGMbiMZ1ElAnfWGTu5n/HCYcVmRwpXSesV5FxgcXfzveHAxoNG0OYy+9QZXmKE+9PcI0luorzF4iiGsfBVq02LBuBmCVpUCb1Cwa5XCr83LGNeVqhlf2Vu1t+d4L+hue4n1VjPZ7raedojz7acdd9AWR0n80bbVgkPrw2q/dZVG1JlzWdX8ccGNhYL21aptTfIFPz3LKK1nUMLvE17oUIqgoE7hz7x5jOZlqhHRWcr2/Baz9hYo7KIkwRvbGVtXG1AsGE7/PtjHwAuM2mlaJQyOYziDKvilixgvb2ZQ0Pu2vZ8z0lFqJ2eZ49QhW4b51LGkmogS7ek39vXip8NKF1GKRtpLewnKJig1jmcZddMZ1/Qx6KFEwfxFjHd2arCx5f1OKBLSmHRlXDYt00j+jwOMaXPCTPVvxZG+Qo3Md/RT//z4kHDaOXCy4N1tBjmbpNi1dT9Bwmh9rpvKlOt8bLCAeli7WwosZC22krVID5kzzeGTHkfU3X1wzgIP3tmqtLwlz6jPpgmovSA6XTBngWYc3UbqLV5Tonlm5+Eq8N/rs9z5mqF0qhIsfUoL7Sd3M/66R4tDn+9m3FUup8iAc12EO//0IBQy5cWLGW9u51PPVFAn6DFQn41SVCM3rGAMnMKnvt67lrF9rQeUyDviHokj8wNmMj+khyIu10NNiKhF9B2OYg9O7hP0azCiaFCw5CnGP/Yx9qxhXFGoOO/O/owLivSWFi1SuopS1Omfz8e588MU/88jr6dAMHyycoif79Tz6Q7Gxwb0+HIv47Ji9ZPeswiP8zVF8xm/71Tama2lARxmJI1UjbugUJBfw+hUJehZLfhol/rxa0vDNZWeIwQ/HhZcWiSg2+JuNt0US3EtTBTXwkQU2zqaYltHU/SDEURP2sf5J/jw3T7GhYX6n1NGCVYsYsyfp6b710PGA6QLIrIFFxUKfjioxfIzaV/ogaJyDLMx+MMQsxKdHTZJX6HAmadm9OQgwXf7VAM/3aHno22qifWz9XfJz36HGBE7KlvQdoigRblRsG9sysaFv7yFT5VB764Q7F2l7unkHsajg/XnLinU4BWVI/h8J2PwVA/IL0PcfZzk7uMidx8XUVRhFEUWRlJ0UVQEpfN7u1d5sGUFg7oph9annkEdNGhQmuDgesaIaeFkfdAkxpe7DZYjL/xGuUDLmZSk/+/S3oLMMRpdly9irFrMGDXNqKOk6M9HZinMKByvLuGvexkfbw8L8NMdGimPrmNYcsO/z1ugNeQooxbTrLfg3a2MBwao1jW+TMrUugsOMx4epF9HZwvMfi012AzqLT5fMeJ9A9Xi5sxjvL5ZQOn8ijVoJWe+jZz5NiJrnpUsuRaibNtDTYo8OLmHkTpKYUmfOmUn3n6akTdeI/L9fQRZ44zgkS54awtj+hw+RW95jKjXpFBQVMuYPJuxYhHjw23K2+FZ4++jairf7GEkjlB34QoK5s/Xn/nhAOOLndr38uUuxmc7lZX+8QDj9U0GmZsuGi2zBfcNECxZyLisl5ocXmf0rFZN9f4cJqUo/b9mSfh9O4ON+MZkwcFNGpnv7KfP3WqA4B/7GbeWCSjbdbe71NBAh99B9hw7UTKPzhznwVe7GZ58Bc23luubObJWHxZHGHPmsppZuuCuCn3RuyvkVJdAqHQZFxD4xyrrjKOMb/cyTuxQIYS06ePtjJ+eYfztAGPiDMZb2xl4yw0ccePz7YzXNzNe2aSU/g/7GXjWrX5wl4JiR9AoRKWpltTN1PcY4h2nzjrd1E8FkxRBYJzg6z0MDmo6ekkvhV5xAcH2VXqJzbTjC9ZcNeMPtzFGzfKA2jmHxt4XS6aH4ojisk1kyoolSnQdXb/MgwOr9ZfGFxkUUYq+yKW9BRuWCabNNiJYsqBuBuPdLdpi0Th4eAuNmzYgTrdqNclvfmaSn+xgfLKV8eNhN/CGG8fXC8rrPOhb70XvOh9qZvowa74PZfU+lNR50bfOi1lzFMDjVTfe26LAd+48Rv8GxvApjL/tVS39+z7tLYwvUGVo7JdNAYE3X/DlHkb6GMM3Zwqqp6jF4XktallyBY8MFlxfphF8yULG89s8oA6u/XE3x5HlDjORK+gka67r8mi/JtmDJqoALXlGB1Sout9Z0DSglbG4XBXOq5uMPpbkM0fEENu7ZLH6rlc2qvZ8ukOL4Cf3MHDMjc3LBEkjveg/yYfZ872YO0+waD5j9UIXVsx3YdkCN+bOZcxf4MW4mT4kjfJhzGSPauRLbuCQBoAfDzE+3a7M8+c7tVOrg7a7nRGs71nFWL88TMFlj9XL4Hwt8j86WPsTu1YrXEseJfhyB+PCEvkhrsxzoafcQ+T0O4jSXQl/rBCc3MO4s8Ko9pcpEZk+WhmYNzYrtDAF1Oc06y34apcWwCnjzJAlLqCvM3UO48Yywf7VjH8eUH/44wHGjwfdyK/xIm1MPDYu82LbUheGjbfjj0VWeNOtiE2wgrpb4Uq14kq/FVlD7Vg214k9qwRV03x4cogPh9epaf882Hy6Q11HYa0K6OfIgFIE/eoZH+1gmAPqDlxBpcHIoL+oqyAiQbU1NleF+tUuRpdqBqW5O0rQTWS6OoboEUdd2UwvPtzGiPOrQEqMrOMvuxif7Gb8eTujX52aK6ULkkfpLV9Q9EsTCR3OFzTtpeYRlSV4ZTPjh32Mnw668fluxqODvBg13Yf3nnYjdYgN1MEKamtFZA8rzMk22JJtcKTYYE22ISbR+PcnrLg214pdSx3Ys8aDeyrjsXqJAMd+KUQcZRRP+KUAPQYmbNFP/eB9lfq1Oz/MxvyxQlAzQxsEHLkK2Shb8NomRt0MDyjJMdpcYCJyJNiJevDB5csEu1eqf7PnCaL8SjL2qmXcUSEwpwmiMjUXpRTBlNmMFzaqQDn/3BlBRI7S/i9vVCf/t32MBwb4MH+BD3tWOxCdZgZ1MSPWb4E11wJLQI811wprZiziUiNhTouCJS0KcelRoK6RoNaEkhoTvtzjRatB8Vi/VICjbnxkCPGEIcDEUerjfv7eHEEtr763hTFgkhGtjQCTO1ZrKzimbmDtEj5VAliykHFwnQeU4NwW3S6GyFnEFsqSEy9u0L7kEBi2G5G2zRCta1xTqkJwBPX7B9Yw5s8/8+3+4rYzBS0rBH/dzcDzbiSO9GLiHB92LXeAWltBj9th6WaHucvpx9LNCWvbWJgeI8S1iURcmyjEtYmC+fFIRD9MoDtjUTjCgXe2C+6pjMfrT6tr+NDIWl7crDmuOfcs7ytVsHW5FupDXRNNiwUvbmAMn6KZjD1PkDFG0HaY+sGyCYI/7xGY0/jdmBY2oriA+3pfoYbojDGGuWUo8yEFCoRbVggmzmJc2kvLiZZcwXtbGX0nnPl2Q0A6MgQx2gnSRgjwlhtTZnngr43HK5ucoEQTmj/CeDf+Why/+Brsbno1dje9Gs82vQYvXnw1lpMFy0bX4t2vvsHnn3wOfAPgG+CrE1/ih89+wMBxA0DXEsZOtGHpMi+6VXuBo258s0c1p83gc+fNlCIYO12hEmWp7+9YLcipNtpNMlRol+YI8sZp5vLIYMEXOxnX9hVQqv16okzufms//eZ9lRo182oYeTWqbQ8NElj9gqaNWjeuLdWC9iOD9Zf+nMQ0GWnbFSWCLsMFXYcLdq5SZ9+92ocdawUP9rKBEk1I6BSP9xxX4KMLrgL+cANw2fV4/+JrcOLCq/AVWfHsU0sBAF+f+Bort63Aip3L8OWJvwAAJj1VD7qLQB0s2LvKieIGHxYv0Da7hBEKgM9F6FK6pqofbmNcWKTPdkGRoM8Exq39NCFoUa6uZ/x0fb1mvQWf7GB0qRZQR+tjRCnuwtTR+iJiZBEz5jDaDtVfsH+DIvK7+huQJkvw2GAV4HVG29ppDHCWJvKT5zC+2a2agGfVdMdN86Bqpg9L5ztAj1tBwTh0bePEtOvvwu7mNwN/uBa44iYsvLgZxlx0GT4lM97euAN/BXBNdjNQewK1JPg6OfHtV99i9daVoPsI1MmK7pU2LF/qQXC0D3jVjeLxDEoMY9IzkReUrcHisx2M28vVV1O6oGMV4/MdSqPhdSVKOE9/3hQQvLOF0WeCgDI9hURJrobSOg/eflpV9MFBgpZlmpNe0UeQMoqxaCEja0y4NaxkguDtLQo07Y3y32i/tqztXq2A9Pt9moKd2MnAETeKx3ux5CkPOpTbQJ2toDwT7mplwoqi/nj+pjswPCIG6+Mvxc57WmFI5654jQhfbjmKvk/XgFoSrh3dDNf4m4FiCX179cXKbctBrQj2dBuoixVrn3Jh6EQfXtmowP2OcjmVFMTmKExpbM4xftWoD7cxuo/Q5wtxhzeUap7fbSQjJkMt02akjUfWMqbMFlCyazBRmmddw0xN0ClR0GGEoMsIxUCR2cqM3Jwr6DjCSJtSBUMmKYimbH1TjUFz3UzlCj9tlLZ9tZvx9hZGeYMPq59yw5pohTXZBsqLQ6dHrFh38/0YXTsBDyUlgYjQ5qab8UXLB/AdmfDqynVY9dIBlA0sQYsnb8LFVzVB80uuwtwpczBzxXRQK4Jk2kBtrZgwyYGp87yon+EBXnHj9S1aXLcHBPnjNZLajCAYZWRP0X7B65sZFQ36bPY8wbVlAl9oDMNgix4bLLipryrWuiWMTcsYlCrriBJc6zat8GDdEi1+X1+m5lk/U3BzP8GTQ5XOuqMiHBRmz9MOKco0qm7Grd1eLsAzSoA2znm/38fYskzQMNuHuTOdoI5WuNNUgO07+PAtOfFMdhB9J9Ti4osuRu7lV6He5UW5mRFMTMe0WfNw8On9eOzBx9D0kqb47ptvAQANC+tA9xI4QzU6c6gNU+Z6UNHgBQ67gWOMVUsYrjzBe9sZjw9UprvHSCU6rIZZvrKJMXiSkdJlC27sq34OhzSDwkGN6g8NVZJlxSLGlhUCSpF1RImuI5uXe7B2CZ+aEMoepRV7vKRYqGS84kMxOuy3rdBxrBCEYSNaz1+geeQvAO1Bxpx5gvrZPoyrd4DaWcGGANu0EyD+WuCS5ujaowcG3vcgyrwXgOwMm68JLvTZQES4pOklGDd2LOpqJ+Dvf/87AGDiU/WgewwBdrGiS3875sz3oFetCvDT7SqEI+uU9Zk9jzFjrhaXUkfxKV7y0FrGjDn6jDF+wQ1lgplzGf0bBGV1gqwxSj607K8aWD+TcXyzB5Tq3EiULl9tXa5+jtKNkl5P7abqMNwoLyY3crxpgt2rjJ83/AslGT0pLytQ/ng74/sDCpg/3MbAITfqZnpQNdWHCZMcoPaGAAttuOXhWKyieGyM8aGL1YpKlwc9LA7YLmuKrC7NUVt+K7w2K25s3gy73nobb/3jB6w8fAgvfPoNCsZVgB4xBNjViif72bF6iWDoZC/wjPuUFfxwQLOmb/dqP/bgyXyqW4LSBBuWGtRWmqafdw0U3Ntba94hEjgiXVM6Sldc/MZmgTmXXyfKkpNH1zEmzVJS4MmhjE7Dld6hdME1pcq1OYNhDdy+IizAKL/Cms92MvavZqSMZny9h7FlGeOtrYx/HtRewAXzBZPm+jC2oZEGdiO0LH0AsxfMRsPCaTi6di9e2XUUf2z1OFpdb8OJQ62Bbzpj8rDb0fyiCzHY4sV0y4Woi7wIT0XHo/tVHpDfdkoDu1XaMHOuB0UhDWxkBZ9sV3N8d5vOkkTlhHPixQsZ24yxCVNAZ0tmzGHc1k99ohg+nvP1+fNqBH96mmHL45MUlSNfvbhR+5EpUZA4knH/AG2QfGebqnvHYQpPQpNCe1epKVCq3tiDA0VxUZoCz2MbtSfm6t6ifuQwY+tywfhZPjw1ywnqZPjA1oSEhjzg+7X4/M/DcOyTV/AZ/oqs5DwQEfYsvh/4pD2SEpuDyIVvLM2B6y7DD23iAVtzTLqyKSjbrALsZEVulR3T5noxcKIXOHIGAR5nlNadTv6GBLjTSGNDkbpbNePuSkNx8k+3wLwawTtbGY48OUnRfjn58kbGqKmGT0hWE95pkKih5nA2CkGUJTi81kj7UhvxhhnGKEG2oPUgQatBGsHzxunrnNjB6FPnw4qFbkiKkgXUjtB1TAIObBiO+TVXYOyCVNQfnY8BfYfAQoRHWl6Om69uittbNcNl1BQvtboEL1S68Gy5Cz+0vgz1VzUDZcVpFH7SihnTHJg614fpsz3AIffptZTnGM9t1A6K0NxdSIBLngoL0JYnuLxEC00tyg3qrtFcH6UJgoYA7XnyFUUaGlhjIO3LeyvR+NU+hiegPKA5oDUHl4GDjq5j1M/ks6ZxcX4tDjmN5sfFCxl40428cV7MfcqLlMHKrEQkEK4P3Ivje2dh8fR78MyesZh6aB6mrpyMB2++H0QEMjlAdBFGtLoAb4yx4YMm1+G9a67GiSwfSm+7GBQ0KVvTw4r1i92orPfhlY3aQ/2XXcr+4AXGJ7sYV/VWt9S46P9zDXQEBRcXC+6t1NpMyqiw4CyGopymgZQlJ4+s09oFtRWMnSfAa4zHBmru271am4eaFmsOTFkatSbNOrMAvQWq8pyvb5QyBb5cwff73Fi7WDB0qg9rFjtAT1jhTDeDWhM275qDN54ZgR0rcvHUyhEYsXMa9jy7HUmdMnFBhAvjr7gYb04z46M7rsBJ+iPez/XhzZ5NcPW9HkQEzaC2VgSrbZi72IvskV7gOTf+eYDx03413fkLGE2Lwj3dP8+HFy9kbFkeHh3zFmlz/DX5gsB4xjtbGMc3MK4whibDPlBOEqXJya3LGYsXakvGY4MF9w9QPPj4EA0gd1dqkchpNN/sXqmQ4EwCPFOvXvM+RkvZMTe6V3uxcbUHPSttoLY2UAfCA6Wd8PWfj2HF/Ifw3pEBWL5/EXIWlWDNp8fwRms/PssivJzSBF/TnXix/UU42Ucw7OpLQTlxiEm0IaKLFUfWu5BV48PeVYIf9uvgTsv+WoqglHBbyM/5SkrXDohVi40Zu1zBRcXaX31kvbqfd7fo+Fmz3lqi0CjMiAvwm0TJruc2LTNwYLrAnCOw+AWmXP3FV/ZWOufCIkOARhResvDcVJa3QEnICwsEfzYiIJ5xY8ViQc9R8fjTVjecCVZQNyvoYUJ5w2B89doaHNnTA386NBQLd89A8fYGHAgm4GhHwklqgT/fcTn+OtqBdc3/gOgODlDADHrMipXzHZg8z4f0UV7gTbcihJ5yCtfJWZo7XY18+vRGOPCiXoIfnlE41rXayMiSjPmWdEHDLMbxDR5QpnMTUYpr3cZlHqxfqnMV/rGMcdMZjjxlJv5YIRg7g3F7f0Gs/5c48JxdVimCybPVB328nY2xUzeKaj3oN9GHD7c6YepuA7WPAj1BGDV7LN59Zhamj7kG77y1Dd8BWN2xNfa1Ifyp24X4KasJNt5+KfgxNyjXBHrUipp6O45u8OCBgT58vlvTyIETz16naXycBpx5ZRNj0EQ1cWdQcGUfQYsKozMsUZXJFQqiqZqJPL1cjFQu07OuboZuxqAkBc8tSgVNCwWjZzBMWYKbCgX3DxTEBFSAW5Yzlj51bhOO8aszfncr45/7jQrcDi0q4ZAbSSO9qJnlw0dbXbgyxw56OAL0CKF9aWu8c3wTAOBjAIdadQEusOO7dk1Rc8OlMD/hBCXHgtpZsWSuHcc3edCiPB7Pb1DCAs8YTeNJSqSeq0vMGVQG5rXNjMqG8Cja7eWCRwZpX7U1T/24JVvJVkoRrF/C2LiMQSm8jqiDc3LpJIONSdNpopIJ2kT5jBFcvtjJ6F4dbjKaP5+xd1U4Fz4bC31rf8FXexlf7zq9FvztXhVi2igvcmri8fYWxrgGJ6xJsaDbCY7ut2HsqgV47sRJ7H6sJ5aTHdddeSGogwmUbEK3SjteWuvC/IU+tBrowzFDeCeMzoV7+6s/v67s3L06poC6pve3GmRyugqxXbWRVRlVvg+2MbYuV/qOkhWFTJotoCRXFdFDjsLUOi0oRftVff9+gPHtHmVQXt/MOLiGFddl6i8YN12jEmXrLZ5RgNn6AJ/u0Frtpz8rqH+zl4GjboyZ5kGn4fGYt9CHHcsY82c70LZfBMztCJf28KB51yZw5JpwY7UJ1Q12bFnkwsZlHhRO8CGh2ouPDKrso2160d/v05GxKbMZReP51FTS2d7jXf31Pf6xQr+OzNFsLGesDj6OnabLLPavY1zYS4PoO1sYJcrGFxLlOBNu7quM9F39tR58S7kBqI25jsgMrQ94jcmkUVMZL2ww5nDPIkBHUKmixps0PtxmCO6Y0dpxjIE33Hh/J6NXjRfB8T40zNHa8Lz5gtppURg5z4LZizyYP9+D6fN8qJzkQ8ooL5YuFOBZN77bp0A5VEj6cJt2MbyzTds/InLOQelnC+4doDMkN/VV4TnzBZ2GMySUVBjzIxcXqjaHGOlOwwWUaHuCotLt1/sKPfhgu0o9VGQOjtNZNFOOMa9mLIWgNMGsuaqV5zLhEMaqmmK0pRk9fuuWMFJG6UB09RSN5l/sYeAF7TSYOtuDkgleDJjoRc0ML0ZN92LkNC96T/CiarIHz60T4E038IIbn23jM9eDjzEWLtACOWXoM/wc/4UEeHelCvDWcoPvzBJUT1YNiw2Em+TtefparYeosl1TKqA02/VkybTaKZ2/eGGjRkzqKOhQJacafx4dyKD2AmuOhndKETy9TLcInQ/GULoiehxivLhJd8Z8vovRrJcx85tiFLH84aYiHHIDRzUY/H2f4S8PsPJ7r7vx9UFG4TjG6iV6ISd3h4X4yXbVwh/2Gb08xxnbl2uvX7T/DALMOl0DKVt94kUF2jcYma1B5FS9OFXQr07w3jaBye9+PzrNGkWmVBNRouvwssUeDQxdBLnjNRpbc9UHlNczntsQ3sLx8gZG/azzlzRDU5Yn9zCeXqbYrPcE9U0hfObO13ay4UYTeGNNOmE0V/5ll/7bzpWMy3orW27OEcydb3R6HTu98+u9LYw58xi5NYxeternzlT8pyy94BM7tIhECYLOI5QMSRmphHJkts6bNC1Wk172FGP/agElu3dZsqxE5uw4okRHfUmdBx8Z0+eX9da679e79Ta/36cBpWV/gckv+GYPo/05WjpOe5MZgm2rGOUNRk9hyi9NilIE/SeqID75WfPRX3Ypm1M7K9yWG1+sNQ5K1RrO6Glaox45ldFjhLFHKy28PsocOLMJmwKadXyyg5E8Qi+yW7XBRh/Wyzi5W8njy4yM5rXNjPEzBJToHufMdRJx0E2Uxcm3l6um3NJPKaoNS3QI+s7+Oj8RmgMpr2d8tUcLSta8Xze28Mgg7Xg9K+TJEtzaT/CPA0oChIjQz3YqLBk9TQnQ2EaC9xlO/VTzU0a4cTza/+umo0L03KubGRNnqkVdbMynXGL0GW5dzti9lkE5gouKtDemU5UHlG7vEpcfR+QOusia67o6Kkfw/jbG0MkKkF0BIwplCcx5qnmUIvh4D6PBaKj8NUM0vkIjEJ1j0DCUtYyYoi0VX+/R7q0Q8P7LLi3i3NiXz+jLQmSn/J6RimTBlDmsTfVpqhTOoPrlkBaH5l7SR2s3bpMC+Sd1tVxi7hZH5PK7yJ3jIkqS46uXCg6t0ZuwB8NjByE/NW4W49vDDM7VTOO3DM+cbxgmzphIHzPV8GXPKhZ9byujYZZOAEjB2WHT755JyRZcV6pl0I7DFbI0Nncp0MunJF0ldWy9B5TseiYmPYZMabFE5qCZTEETUZqjJn2MFyf36FC0KaBpkDVXI2bGGKW5OgxTX3Ymn/I/HRC0GFr/wEDBrhUaOPAC455SBnXVcdZ/+cRnoQpn8lzGT88yHDlyqtHI2wjTRuVotB4+2QMKuKut/a1kq7ARmXPjyJQbS5Rle8xX4MFXe40iepKccvpjjbVJheP1QWIDv20WJNRFf77hwVOD0KnhxqbP9zCOb9XelfNpX6gbTPJ/27B2jDFTfGg946dDjGtKtDQRmW0IOFPw6EClyW6u9IBaWe83tzST5X4LkdPvJGeOkxwBRyylyEc7Vgk2LVennThS8OVuNafOVUoytqxg3DeAEZH967UhNFEe6/91gvcVGoN/SQJLjuLT0Aa38+1SiMpWk/s1o2bxhTpE+YdeuhyIUvTZ8SJj9lzGRcWGInXQku1ruz2gbvwWOSMpwhRBkfZIInuOjew5NrJlW4kSXQ1dqz342z7d14JnGEsXGX0hCbqHqutwnUC/p7/e0PmEGALUReMZJbV83imjMz2gI6DQ6lzEgBj846gpjAcHahA43+tbcrVsmzpKkDmGcUupjnckjORTxMT2FToa9tEORsUcH+h++8ioCyMp5poYirk6hig6NZqiU6MpMjmSKM10l8nvwcm9jH1rlCygJKPbKkep/S7DlZUYP12Xip1tLs5XGGZ8KVkwZgZj01JGfL4Wan7rYgln8OyC9xVqlLyjn+DNLYzuIzUhiM4KryY4k8Ajc/Ric8cx4gsFNdMZTYrC20A6DBdsXKq5/F/2GCWKNFOL6JwoivXHUKw/hshR4Dh1nAV2okR+bsZcwdE1Sgk5Db8V7RfkjBWU1WmPcM5YHVSJyDn77TYvFRSOZ/Sp067PrlWC0gm/TQt/zXEG1UVUNjDaD9FRsawxjOwxujvrTB20kq+E8ZPDVPuKaxl9Jqhy2PIMF2IMlB9aw9i83ANK5H22oIXsBdZT5/QtHcVuolzOvbbUgx+f0dVNlKZmas/Tic1b++moQ/F4JRPOBlFCb3z9UiUpLLlhmHJvf6PYVPiv2dhBKTqi2rs2PGEwdbZOeFL6md+jr1Ax7rV9BMufYiSO1OdrPP1EmYJbygQ/HWQ8NNgDyuQULnQTF/KpQ6auceHTJY5iu5js1MP92ebVHhzdqJCFQ280SxtvulUznhymgzbROWf2g6E3+NBAQUW9MZeWJLihj3ZwNS3+/WOxjU+0X9njMdMYUVnqLi4uEAybzLio8PRZuZ/n6RcVaQNoh2GMRwad3izqLVS/v3IJ44WnBZTo+cCc7jDZMx3U+FBcQmz49IwlU89oomT70LsqvcAxxsMDw7tWKEtX27UapJW7munqO84mCK/hm4JjNUe9f4Cg1mile/QM3a2/CwinawPQixu1FnJDmRIWbQbxWafmxRC8fyyjol4bSwc0MK4tC68poCzBVSU6sd51jA/U2VIe157I3DnitEOefP7F4Tx3E0qUr59eJaqFSQY+y1aWdsgk7W5KGql82tkinte46biAYMF8Ru44QbBGS4jN+xgdD79zHUoogFGqbglZv0RLmbUzjWGh1LO/bqjX5fEhgoIaQf8GRsF4xtV9VGND2rdiGePVbQJK9ZyIy4lz2gOxZA+YTjvkLuAzHDdRlgy7oa8HeM6NjlXqZ5xBbXu4rVwj8rz5jEuLw52dZ6uN5NUwKhsYFxUpKM8co9vVOlQZO7Ay9LW9v3IHgtUYApd8QfZYQe0MxYmPDFLmePIs7e8508XGG3sEKUtdy7Q5Cntu6RdeDETpglv6KifabpgX1M1aEZMaTTFppl8csqXbznjs6TYb9ZBP5i0SfLDHmB8JhrsTOlYJrixRM2g3TCHPmYRoy1PKKDBO6aaHB6k595nAGD1VhfnEUH2wiGxjvCxbo3u030jqjSEXygzvZu1WLSitY3Su0t/fsUqZpEmzGB2qdNH3mdgfc64yLZUNSlG1GaIdaKGxWJexKvTIJsbOdQJK974dmxEXHZ0cTbGpsb84FNk98oyHuhBRsiVb8n344Qhj6FQ+tUTHna+3d2+lLnotqVVGNy5w5hs3+bVYnzpaIUPaaEbpBMYTQ3Xqsmi8woieI3RHYMv+gjv769/3DVCf++BAfdikkYIBExWmVDYwhkzSjKFXrTY8PTBABX0mjeZ81bLOwxWy3NxXkF2jnGKUQZVRopH3H2dc1dsD6m5LtaaZyZpuPeMhe4H9jMdWYCNXoZ0oxbM3Z5wHeCHcnGMK6JsYPEnrqX3qBJecw5RPzeOmq0DyahQf5oxlJFYz7qnQjtDSOl0NmjtOGeWi8br7b+hkRsIIFVavWkb7YUruthokWLhAW/OSRhmscUbY//7CZxpDkh2qBKOnaaT2j9UeIIfROOXOFfx4lDF8pgfUjbdEt46iiIciKfLRqDMeik2OOeuJToii6BTT7ZTixe71gle3K6yJ8esbbNZbFyoOm8JoWaEzFabA2Ue/QpHc5Bc8OlgXJGaO0THVmumMxwYr+E0aIUgZoYOCbQYJ7u3HyByrfi5vnG4TqZ/J8I9TP3pbeXjb5ZmibrwxQXBRscKq9NG6V/r2Co20llwjSCYItq9mvL1TQH4v4vJdN3KBk7jQddajGyrPdjoap7ttsC8YDzzHqJ2tpuzK18ByZ4XWHB4ZrGMBV5Tobcq5tqwVhH1diwqtdHUdrhG6vF4jvN8YPZ01l5E4Ur9fMkGQPFLZogcH6l5Aygxj0bMFIZuB+fzjGMFaLWq1Hap+25KrrXvUU1BQy8DLjGv7eEBdXWXuNDu5MhznPES55zl+ouggEeXynnbVXuBltw7hJGpO26JcTaF9lfqztNEGAZl9blo9RNbGGRlKjDGQeGs/Bet3V6qpPTlU+3NuLNPWWzFI0NDHYpwrm/EVGnPPSYK2Q7Ucce8AXZaWM1YpstB6qBZl2o1QMMkL6s5bIq0RxubdiHMf6vsrTgVRTDDmEurs/Wb0DA/wEqOZMbXpCAoeGchoM0R91Nhp2hp7R4X6nN+yqdJtEA2mgCDSgDeUqeYXG9DXkt/Agsf6ddzs7kqFUtPm6PvsMlwzIYfRrucKKCO9aIkHlOL7jFJi4qk1ET1KRK3PcyjqVx4iopam1lTgw5ZVgh+PMBz+8HCK5AseGyLoOExJhKGTGA8N0o4Ga+6/dwWeK18RwRUlgkETtcv0jgqFPlKg65LteeFVLB/uZry2XUBpHlA304MRXYkozdhQmX6e85s2mLeMoZi+nhLK8OL17YwvD2j3FqXrbVpyFV+1Har9JYMmKhHrDhpalaNa9r+xxdJXGN4ZLQXqCgoNquruSsWM91QaC3sKw8u4j25kfLWfYQrEgzJceVGNNhf/qkOP/MrzIFFE5wiKyYokSrFVR2f58MEuxqd7GNHGFHt0QPDHckHWGMaTQ7W9In20TnymjVYfxkaVn/P/NYILpWXWXEUF3as1CN1RoaMKfSYwulYz2g1l2HONgXGDdDi4nvHTYYYn3wfqbhkc3TOCqCv9tnPeIBI6QUNluxJZskxEWZ5JUZke/Hkn45sDDGfA6K/L1b7AUEDoOUJ3uZQ3CAZOVPBM2RoAInOUx/utGhlfqIEq2q+abQpoV1niSB2UfnKommyHYQxbns6xWHONwRpjbf0rW1R4F+R7QWnuMTGJkUTt6XcIMOk3ngSiuKw48hW5idLck8jvxevb1Qk3L9HobAsaMCdT0H4YY9gkTbWmz2FUTRZc3UdrrE8MUaqestQfReVo6mZqJNR4g5GO9KvZhXYXOI1Z3qRRih+7Vyth0WOEgu1+dTojFxtoNCSUJIgPCv62n/HFXoErV0DJrtGuoI2ikqLUdP9dAvQWCHGBnai7bTAlebBmmW6JTBmlFa04o63MFBBc00fN9/oyTbmu7qPs9pBJmo7dO0Cb27tXa3p4RUmY6Y4L6GXc2k/QdhgjeZRmDn3rFID3rWNcWaIYslOVdpW2KNdOMkuuss4WY3f/Y4MEOO7G85sEkVk+UKK9vzXbRK6gg6KS/90CLBRyFtoprl0sxSS58ijZox/p84p2ToWGdtig96NyjJaJYkHVZD6VhYycyhgwUc08Y7QC5vIGY7Q0SzUyb5ymjf3qdWdhwghdqt2rlpEwQiN+pyqjl9EgITjfKEka7R4Ns7U0O2muRtuoLE53+q1kzjSTK+j8P9BAQ4CxbWNJMpxkDlrvokT5pmV/T3gt+zBjZ2mGFsWbFGka2KRQfdTN/bRgdVWJTkPm12jWkTGa0bdeKa/8GqXqM8bo9wPjBE8M1WVhTYsVZF/TRzHfqf3WhbpmhXoqKXFyt/YoPlkloE7yOXU0t5AiJzly7GTO+g8QIKe7yFZiIVs3q4U6OjdHBryYPV8ZjYNrjBWeiWFBhob9ovzqnyJz1MTvG6BCvbJEkDNWhxcnzNCPAbquTJu/HxqkAcFinIgchS8+I0UMbYC7pJdg8zLtbFi/TNkgSuU19lRHjOmJWOJi13+YAEutZG1vIXtiHEUHHInUU76/qZ8HL23StrWnlzNuqwh/GkNsIAyufUbtglJUSOMM0vWBgVqzqJ4Snu8NkaTeRsDclBv+RIgrS3UMAc9qX02rwR5QgnwbneXu7ClykTPVSbH/yQK0JpjJEbSRPWA3U4pzEiV78WS1Fy9u1k7VlzeqWYY+CSLUpWoyUrXLemvAuMD4qApHngaf68oUhDsbfdZI6DKcQf2MpsNrtYb73hZGj1oPKNML6mkfb89xmDz5TFzk/u8QoD3fTna/new5VjL7rU0pwbGQEgR/HODBqsWCv+3Vzv1n1jCGTVZqK77Q6FFOMT7OIrnRZ2v2lFOTR6FM4/4Bii13r9LtIN/tZWxZLnh0mAeU5QE97Jhp7eFoYsuzkCPLQVLAxIX/TQIM2MmeYyNrgYXiOsSQrbPDF5EnQylBPrYXeJAwWrBikQ7ifLlL+5xf26SmvnIxY8ECbWurn6mrkFcs1uGWlzdqV/6Xu3Sv4Ial+mErXCCgRPmAkpwD7EVusd5lJnt7O1kLreTItpPk/7cKsNBCpo4x5OhsJylh8vRiiu3ivI+6uRooTd6IyhE0LxMkjfRg2GTBqsWqSTtWMo6s1RLozpX6vfVLBCOmMdLHenBzX+MzlZLkNUrlutgA381BN9nTrMTFbrK0/P9VgCVCjvYOciY5yFPsJnue+xLKcnelNFcVpfBqSuGNlMJvU7p8R1lykrLlJKXLd5Ti/hOl8kZK4lWU6BpCWe7O1lz3Re6gmzjoVgHlucmeYfu3CvD/DQArVIzHvssc8AAAAABJRU5ErkJggg==" alt="" width="80" height="99" />

                        </Link>
                    </div>

                    <div>
                        <h2 class="font-bold text-xl">
                            Pengadilan Agama Boyolali
                        </h2>
                        <h2 class="text-green-100">
                            Kelas IA
                        </h2>
                    </div>
                </div>

                <h1 class="text-5xl font-bold leading-tight">
                    SMART
                    MEDIATOR
                </h1>

                <p class="mt-2 text-lg text-green-100 leading-relaxed">
                    Sistem Penilaian dan Evaluasi Kinerja Mediator
                    untuk meningkatkan kualitas pelayanan mediasi
                    di Pengadilan Agama Boyolali.
                </p>


            </div>

            <!-- Decoration -->
            <div
                class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full bg-white/5"
            ></div>

            <div
                class="absolute top-20 right-20 w-48 h-48 rounded-full bg-white/5"
            ></div>
        </div>

        <!-- Login Form -->
        <div
            class="flex-1 flex items-center justify-center bg-slate-100 px-6"
        >
            <div class="w-full max-w-md">
                <!-- Logo -->
                <div class="text-center mb-8">

                    <h2
                        class="text-3xl font-bold text-slate-800"
                    >
                        Login
                    </h2>

                    <p class="text-slate-500 mt-2">
                        Masukkan akun Anda untuk melanjutkan
                    </p>
                </div>

                <!-- Card -->
                <div
                    class="bg-white rounded-2xl shadow-xl border border-slate-200 p-8"
                >
                    <form class="space-y-5" @submit.prevent="submit">
                        <div>
                            <label
                                class="block text-sm font-medium text-slate-700 mb-2"
                            >
                                Username
                            </label>

                            <TextInput
                                id="login"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.login"
                                required
                                autofocus
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.login" />
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-slate-700 mb-2"
                            >
                                Password
                            </label>

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <PrimaryButton
                            class=" bg-green-700 hover:bg-green-800 text-white font-semibold py-3 rounded-lg transition"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Log in
                        </PrimaryButton>
                    </form>
                </div>

                <div
                    class="text-center mt-6 text-sm text-slate-500"
                >
                    © 2026 Pengadilan Agama Boyolali
                </div>
            </div>
        </div>
    </div>
</template>