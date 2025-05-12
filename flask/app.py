from flask import Flask, request, jsonify
import pandas as pd
from statsmodels.tsa.statespace.sarimax import SARIMAX
from sklearn.metrics import mean_absolute_error, mean_squared_error
import numpy as np
import json

app = Flask(__name__)

@app.route('/predict', methods=['POST'])
def predict():
    try:
        # Ambil data dari request (asumsikan data dikirim dalam JSON)
        data = request.get_json()

        # Data input
        bulan = data['bulan']
        terjual = data['terjual']

        # Membuat DataFrame
        df = pd.DataFrame({
            'Tanggal': pd.to_datetime(bulan),
            'Jumlah': terjual
        })
        
        # Set index dan resample
        df = df.set_index('Tanggal')
        df = df.resample('ME').sum()  # Changed from 'M' to 'ME'

        # Convert to numeric type explicitly
        df['Jumlah'] = pd.to_numeric(df['Jumlah'], errors='coerce')

        # Train-test split (10 bulan train, 2 bulan test)
        train = df.iloc[:-2]
        test = df.iloc[-2:]

        # Fit SARIMA (non-seasonal)
        model = SARIMAX(train['Jumlah'], 
                       order=(1, 1, 1), 
                       seasonal_order=(0, 0, 0, 0))  # non-seasonal
        results = model.fit(disp=False)

        # Forecast 2 bulan ke depan
        forecast = results.get_forecast(steps=2)
        pred = forecast.predicted_mean

        # Evaluasi
        mae = mean_absolute_error(test['Jumlah'], pred)
        rmse = np.sqrt(mean_squared_error(test['Jumlah'], pred))

        # Hasil evaluasi dan prediksi
        result = {
            'forecast': pred.tolist(),
            'mae': float(mae),
            'rmse': float(rmse)
        }

        return jsonify(result)

    except Exception as e:
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
