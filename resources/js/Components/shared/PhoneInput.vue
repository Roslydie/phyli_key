<template>
  <div class="phone-input-wrapper">
    <div class="input-group">
      <select
        v-model="selectedCountry"
        @change="updatePhone"
        class="form-select country-select"
        :class="inputClass"
      >
        <optgroup label="Popular">
          <option v-for="country in popularCountries" :key="country.code" :value="country.code">
            {{ country.flag }} {{ country.name }} (+{{ country.dial }})
          </option>
        </optgroup>
        <optgroup label="All Countries">
          <option v-for="country in otherCountries" :key="country.code" :value="country.code">
            {{ country.flag }} {{ country.name }} (+{{ country.dial }})
          </option>
        </optgroup>
      </select>
      <span class="input-group-text dial-code">+{{ currentDialCode }}</span>
      <input
        type="tel"
        :value="phoneNumber"
        @input="handlePhoneInput"
        :placeholder="placeholder"
        class="form-control phone-number-input"
        :class="inputClass"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'

const props = defineProps({
  modelValue: {
    type: String,
    default: ''
  },
  placeholder: {
    type: String,
    default: 'Phone Number'
  },
  class: {
    type: [String, Object],
    default: ''
  }
})

const emit = defineEmits(['update:modelValue'])

const countries = [
  { code: 'US', name: 'United States', dial: '1', flag: '🇺🇸' },
  { code: 'CA', name: 'Canada', dial: '1', flag: '🇨🇦' },
  { code: 'MX', name: 'Mexico', dial: '52', flag: '🇲🇽' },
  { code: 'GB', name: 'United Kingdom', dial: '44', flag: '🇬🇧' },
  { code: 'FR', name: 'France', dial: '33', flag: '🇫🇷' },
  { code: 'DE', name: 'Germany', dial: '49', flag: '🇩🇪' },
  { code: 'IT', name: 'Italy', dial: '39', flag: '🇮🇹' },
  { code: 'ES', name: 'Spain', dial: '34', flag: '🇪🇸' },
  { code: 'AU', name: 'Australia', dial: '61', flag: '🇦🇺' },
  { code: 'JP', name: 'Japan', dial: '81', flag: '🇯🇵' },
  { code: 'CN', name: 'China', dial: '86', flag: '🇨🇳' },
  { code: 'IN', name: 'India', dial: '91', flag: '🇮🇳' },
  { code: 'BR', name: 'Brazil', dial: '55', flag: '🇧🇷' },
  { code: 'ZA', name: 'South Africa', dial: '27', flag: '🇿🇦' },
  { code: 'NZ', name: 'New Zealand', dial: '64', flag: '🇳🇿' },
  { code: 'SG', name: 'Singapore', dial: '65', flag: '🇸🇬' },
  { code: 'HK', name: 'Hong Kong', dial: '852', flag: '🇭🇰' },
  { code: 'AE', name: 'United Arab Emirates', dial: '971', flag: '🇦🇪' },
  { code: 'NL', name: 'Netherlands', dial: '31', flag: '🇳🇱' },
  { code: 'BE', name: 'Belgium', dial: '32', flag: '🇧🇪' },
  { code: 'CH', name: 'Switzerland', dial: '41', flag: '🇨🇭' },
  { code: 'SE', name: 'Sweden', dial: '46', flag: '🇸🇪' },
  { code: 'NO', name: 'Norway', dial: '47', flag: '🇳🇴' },
  { code: 'DK', name: 'Denmark', dial: '45', flag: '🇩🇰' },
  { code: 'FI', name: 'Finland', dial: '358', flag: '🇫🇮' },
  { code: 'PL', name: 'Poland', dial: '48', flag: '🇵🇱' },
  { code: 'RU', name: 'Russia', dial: '7', flag: '🇷🇺' },
  { code: 'TR', name: 'Turkey', dial: '90', flag: '🇹🇷' },
  { code: 'SA', name: 'Saudi Arabia', dial: '966', flag: '🇸🇦' },
  { code: 'KR', name: 'South Korea', dial: '82', flag: '🇰🇷' },
  { code: 'TH', name: 'Thailand', dial: '66', flag: '🇹🇭' },
  { code: 'MY', name: 'Malaysia', dial: '60', flag: '🇲🇾' },
  { code: 'ID', name: 'Indonesia', dial: '62', flag: '🇮🇩' },
  { code: 'PH', name: 'Philippines', dial: '63', flag: '🇵🇭' },
  { code: 'VN', name: 'Vietnam', dial: '84', flag: '🇻🇳' },
  { code: 'NG', name: 'Nigeria', dial: '234', flag: '🇳🇬' },
  { code: 'EG', name: 'Egypt', dial: '20', flag: '🇪🇬' },
  { code: 'KE', name: 'Kenya', dial: '254', flag: '🇰🇪' },
  { code: 'GH', name: 'Ghana', dial: '233', flag: '🇬🇭' },
  { code: 'IR', name: 'Iran', dial: '98', flag: '🇮🇷' },
  { code: 'IL', name: 'Israel', dial: '972', flag: '🇮🇱' },
  { code: 'PK', name: 'Pakistan', dial: '92', flag: '🇵🇰' },
  { code: 'BD', name: 'Bangladesh', dial: '880', flag: '🇧🇩' },
  { code: 'AR', name: 'Argentina', dial: '54', flag: '🇦🇷' },
  { code: 'CL', name: 'Chile', dial: '56', flag: '🇨🇱' },
  { code: 'CO', name: 'Colombia', dial: '57', flag: '🇨🇴' },
  { code: 'PE', name: 'Peru', dial: '51', flag: '🇵🇪' },
]

const selectedCountry = ref('US')
const phoneNumber = ref('')

const popularCountries = computed(() => {
  return countries.filter(c => ['US', 'CA', 'GB', 'FR', 'DE', 'AU'].includes(c.code))
})

const otherCountries = computed(() => {
  return countries.filter(c => !['US', 'CA', 'GB', 'FR', 'DE', 'AU'].includes(c.code))
})

const currentDialCode = computed(() => {
  const country = countries.find(c => c.code === selectedCountry.value)
  return country ? country.dial : '1'
})

const inputClass = computed(() => props.class)

const handlePhoneInput = (event) => {
  const value = event.target.value
  phoneNumber.value = value
  
  const dialCode = currentDialCode.value
  const fullNumber = `+${dialCode}${value}`
  emit('update:modelValue', fullNumber)
}

const updatePhone = () => {
  const dialCode = currentDialCode.value
  const fullNumber = `+${dialCode}${phoneNumber.value}`
  emit('update:modelValue', fullNumber)
}

watch(
  () => props.modelValue,
  (newValue) => {
    if (newValue) {
      const match = newValue.match(/^\+(\d+)(.*)$/)
      if (match) {
        const dialCode = match[1]
        const number = match[2]
        
        const country = countries.find(c => c.dial === dialCode)
        if (country) {
          selectedCountry.value = country.code
          phoneNumber.value = number
        } else {
          phoneNumber.value = newValue
        }
      } else {
        phoneNumber.value = newValue
      }
    }
  }
)
</script>

<style scoped>
.phone-input-wrapper {
  width: 100%;
}

.input-group {
  display: flex;
  gap: 0;
}

.country-select {
  border-radius: 0.85rem 0 0 0.85rem;
  border-right: none;
  border: 1px solid #d1d5db;
  padding: 1rem 0.75rem;
  min-width: 200px;
  font-size: 1rem;
  background-color: #ffffff;
  cursor: pointer;
}

.country-select:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  z-index: 1;
}

.country-select.is-invalid {
  border-color: #dc3545;
}

.dial-code {
  background-color: #f3f4f6;
  border: 1px solid #d1d5db;
  border-left: none;
  border-right: none;
  padding: 1rem 0.75rem;
  min-width: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  color: #374151;
}

.phone-number-input {
  border-radius: 0 0.85rem 0.85rem 0;
  border-left: none;
  border: 1px solid #d1d5db;
  padding: 1rem 1.2rem;
  flex: 1;
  font-size: 1rem;
}

.phone-number-input:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.phone-number-input.is-invalid {
  border-color: #dc3545;
}

@media (max-width: 576px) {
  .country-select {
    min-width: 140px;
    font-size: 0.95rem;
  }

  .input-group {
    flex-wrap: wrap;
  }

  .dial-code {
    order: 3;
    border-radius: 0;
    min-width: 100%;
    margin-top: 1px;
  }

  .phone-number-input {
    order: 2;
    border-radius: 0 0.85rem 0 0;
  }

  .country-select {
    order: 1;
    border-radius: 0.85rem 0 0 0;
  }
}
</style>
