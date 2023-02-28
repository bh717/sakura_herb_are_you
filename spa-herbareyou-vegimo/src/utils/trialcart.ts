
const KEY = 'cart_data';

// 例
// {
//   "product_prices": [
//     {
//       "id": 1,
//       "num": 1
//     }
//   ],
//   "coupon_code": "A-1"
// }

// export async function getCart(): Promise<any>
// {
//   let cartJson = localStorage.getItem(KEY);
//   if (!cartJson) {
//     return {
//       cart: null,
//       cart_details: [],
//       is_delete_product_price: [],
//     };
//   }
//   let apiResult = await showCartMineApi(JSON.parse(cartJson));
//   if (!apiResult.success) {
//     this.commonError(apiResult);
//     alert('カートの更新に失敗しました。このメッセージが続く場合はお問合せをお願いいたします。');
//     return;
//   }
//   localStorage.setItem(KEY, JSON.stringify(apiResult.data.cart_in_product_prices));
//   return apiResult.data;
// }

export function getTrialCartData(): any
{
  let trialcartData = localStorage.getItem(KEY);
  if (!trialcartData) {
    return {
      trialproduct_prices: [],
      coupon_code: '',
    };
  }
  try {
    let data = JSON.parse(trialcartData);
    if (!data?.trialproduct_prices) {
      data.trialproduct_prices = [];
    }
    if (!data?.coupon_code) {
      data.coupon_code = '';
    }
    return data;
  } catch (error) {
    return {
      trialproduct_prices: [],
      coupon_code: '',
    };
  }
}

export function setProductPrice(trialproductPrices: any[]): void
{
  let cartData = getTrialCartData();
  cartData.trialproduct_prices = trialproductPrices;
  localStorage.setItem(
    KEY,
    JSON.stringify(cartData)
  );
  return;
}

export function addProductPriceData(
  trialproductPriceId: number,
  num: number
): void {
  let cartData = getTrialCartData();
  cartData.trialproduct_prices.push({
    id: trialproductPriceId,
    num: num,
  });
  localStorage.setItem(
    KEY,
    JSON.stringify(cartData)
  );
}

export function allDeleteProductPriceData(
): void {
  let cartData = getTrialCartData();
  cartData.trialproduct_prices = [];
  localStorage.setItem(
    KEY,
    JSON.stringify(cartData)
  );
}

export function setCouponCode(
  couponCode: string,
): void {
  let cartData = getTrialCartData();
  cartData.coupon_code = couponCode;
  localStorage.setItem(
    KEY,
    JSON.stringify(cartData)
  );
}

export function deleteCouponCode(
): void {
  let cartData = getTrialCartData();
  cartData.coupon_code = '';
  localStorage.setItem(
    KEY,
    JSON.stringify(cartData)
  );
}

export function deleteProductPriceData(
  trialproductPriceId: number
): void {
  let cartData = getTrialCartData();
  for (let i = 0; i < cartData.trialproduct_prices.length; i++) {
    if (cartData.trialproduct_prices[i].id === trialproductPriceId) {
      addProductPriceData(trialproductPriceId, -1 * cartData.trialproduct_prices[i].num);
    }
  }
  return;

  localStorage.setItem(
    KEY,
    JSON.stringify(cartData)
  );
}
