<template>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4">
          <query-builder :cubejs-api="cubejsApi" :query="usersQuery">
            <template v-slot="{ loading, resultSet }">
              <Chart
                title="Total Users"
                type="number"
                :loading="loading"
                :result-set="resultSet"
              />
            </template>
          </query-builder>
        </div>
        <div class="col-sm-4">
          <query-builder :cubejs-api="cubejsApi" :query="shippedOrdersQuery">
            <template v-slot="{ loading, resultSet }">
              <Chart
                title="Shipped Users"
                type="number"
                :loading="loading"
                :result-set="resultSet"
              />
            </template>
          </query-builder>
        </div>
      </div>
      <br />
      <br />
      <div class="row">
        <div class="col-sm-6">
          <query-builder :cubejs-api="cubejsApi" :query="lineQuery">
            <template v-slot="{ loading, resultSet }">
              <Chart
                title="New Users Over Time"
                type="line"
                :loading="loading"
                :result-set="resultSet"
              />
            </template>
          </query-builder>
        </div>
        <div class="col-sm-6">
          <query-builder :cubejs-api="cubejsApi" :query="barQuery">
            <template v-slot="{ loading, resultSet }">
              <Chart
                title="Orders by Status Over time"
                type="stackedBar"
                :loading="loading"
                :result-set="resultSet"
              />
            </template>
          </query-builder>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import cubejs from "@cubejs-client/core";
  import { QueryBuilder } from "@cubejs-client/vue";
  
  import Chart from "./Chart.vue";
  
  const cubejsApi = cubejs(
    "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE1OTQ2NjY4OTR9.0fdi5cuDZ2t3OSrPOMoc3B1_pwhnWj4ZmM3FHEX7Aus",
    {
      apiUrl:
        "http://localhost:4000/cubejs-api/v1",
    }
  );
  
  export default {
    name: "App",
    components: {
      Chart,
      QueryBuilder,
    },
    data() {
      return {
        cubejsApi,
        usersQuery: {
            "limit": 100,
            "order": {
                "Accidents.createdAt": "asc"
            },
            "measures": [
                "Accidents.count"
            ]
        },
        totalOrdersQuery: { measures: ["Orders.count"] },
        shippedOrdersQuery: {
            "timeDimensions": [
                {
                "dimension": "Accidents.createdAt"
                }
            ],
            "limit": 100,
            "order": {
                "Accidents.count": "desc"
            },
            "measures": [
                "Accidents.count"
            ],
            "dimensions": [
                "Regions.nameRu"
            ]
        },
        lineQuery: {
            "measures": [
                "Accidents.count"
            ],
            "timeDimensions": [
                {
                "dimension": "Accidents.dateAccident",
                "granularity": "quarter",
                "dateRange": [
                    "2020-02-02",
                    "2022-01-05"
                ]
                }
            ],
            "order": [
                [
                "Regions.nameRu",
                "asc"
                ],
                [
                "Districts.nameRu",
                "asc"
                ]
            ],
            "dimensions": [
                "Regions.nameRu"
            ],
            "limit": 5000
        },
        barQuery: {
            "measures": [
                "Accidents.count"
            ],
            "timeDimensions": [
                {
                "dimension": "Accidents.dateAccident",
                "granularity": "quarter",
                "dateRange": "Last year"
                }
            ],
            "order": {
                "Accidents.count": "desc"
            },
            "dimensions": [
                "Regions.nameRu",
            ],
            "limit": 10000
        }
      };
    },
  };
  </script>
  
  <style>
  html {
    -webkit-font-smoothing: antialiased;
  }
  
  body {
    padding-top: 30px;
    padding-bottom: 30px;
    background: #f5f6f7;
  }
  </style>
  